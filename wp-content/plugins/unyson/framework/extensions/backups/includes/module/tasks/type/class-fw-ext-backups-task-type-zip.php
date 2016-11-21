<?php if (!defined('FW')) die('Forbidden');

/**
 * Create zip
 */
class FW_Ext_Backups_Task_Type_Zip extends FW_Ext_Backups_Task_Type {
	public function get_type() {
		return 'zip';
	}

	public function get_title(array $args = array(), array $state = array()) {
		return __('Archive Zip', 'fw');
	}

	/**
	 * When the zip is big, adding just a single file will recompile the entire zip.
	 * So it can't be executed in steps.
	 * {@inheritdoc}
	 */
	public function get_custom_timeout(array $args, array $state = array()) {
		return fw_ext('backups')->get_config('max_timeout');
	}

	/**
	 * {@inheritdoc}
	 * @param array $args
	 * * source_dir - everything from this directory will be added in zip
	 * * destination_dir - where the zip file will be created
	 *
	 * Warning!
	 *  Zip can't be executed in steps, it will execute way too long,
	 *  because it is impossible to update a zip file, every time you add a file to zip,
	 *  a new temp copy of original zip is created with new modifications, it is compressed,
	 *  and the original zip is replaced. So when the zip will grow in size,
	 *  just adding a single file, will take a very long time.
	 */
	public function execute(array $args, array $state = array()) {
		{
			if (!isset($args['source_dir'])) {
				return new WP_Error(
					'no_source_dir', __('Source dir not specified', 'fw')
				);
			} else {
				$args['source_dir'] = fw_fix_path($args['source_dir']);
			}

			if (!isset($args['destination_dir'])) {
				return new WP_Error(
					'no_destination_dir', __('Destination dir not specified', 'fw')
				);
			} else {
				$args['destination_dir'] = fw_fix_path($args['destination_dir']);
			}
		}

		{
			if (!class_exists('ZipArchive')) {
				return new WP_Error(
					'zip_ext_missing', __('Zip extension missing', 'fw')
				);
			}

			$zip_path = $args['source_dir'] .'/'. implode('-',
				array('fw-backup', date('Y_m_d-H_i_s'), fw_ext('backups')->manifest->get_version())
			) .'.zip';
			$zip = new ZipArchive();

			if (false === ($zip_error_code = $zip->open($zip_path, ZipArchive::CREATE))) {
				return new WP_Error(
					'cannot_open_zip', sprintf(__('Cannot open zip (Error code: %s)', 'fw'), $zip_error_code)
				);
			}
		}

		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($args['source_dir']),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file) {
			if (!$file->isDir()) { // Skip directories (they would be added automatically)
				if (($file_path = $file->getRealPath()) !== $zip_path) {
					$zip->addFile(
						$file_path,
						substr(fw_fix_path($file_path), strlen($args['source_dir']) + 1) // relative
					);
				}
			}
		}

		wp_cache_flush();
		FW_Cache::clear();

		// Zip archive will be created only after closing object
		if (!$zip->close()) {
			return new WP_Error(
				'cannot_close_zip', __('Cannot close the zip file', 'fw')
			);
		}

		if (!rename($zip_path, $args['destination_dir'] .'/'. basename($zip_path))) {
			return new WP_Error(
				'cannot_move_zip', __('Cannot move zip in destination dir', 'fw')
			);
		}

		return true;
	}
}
