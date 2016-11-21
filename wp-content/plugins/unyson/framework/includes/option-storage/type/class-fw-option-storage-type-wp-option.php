<?php if (!defined('FW')) die('Forbidden');

/**
 * array(
 *  'wp-option' => 'custom_wp_option_name',
 *  'key' => 'option_id/sub_key', // optional
 * )
 */
class FW_Option_Storage_Type_WP_Option extends FW_Option_Storage_Type {
	public function get_type() {
		return 'wp-option';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function _save( $id, array $option, $value, array $params ) {
		if ($wp_option = $this->get_wp_option($option, $params)) {
			if (isset($option['fw-storage']['key'])) {
				$wp_option_value = get_option($wp_option, array());

				fw_aks($option['fw-storage']['key'], $value, $wp_option_value);

				update_option($wp_option, $wp_option_value, false);

				unset($wp_option_value);
			} else {
				update_option($wp_option, $value, false);
			}

			return fw()->backend->option_type($option['type'])->get_value_from_input(
				array('type' => $option['type']), null
			);
		} else {
			return $value;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	protected function _load( $id, array $option, $value, array $params ) {
		if ($wp_option = $this->get_wp_option($option, $params)) {
			if (isset($option['fw-storage']['key'])) {
				$wp_option_value = get_option($wp_option, array());

				return fw_akg($option['fw-storage']['key'], $wp_option_value, $value);
			} else {
				return get_option($wp_option, $value);
			}
		} else {
			return $value;
		}
	}

	private function get_wp_option($option, $params) {
		$wp_option = null;

		if (!empty($option['fw-storage']['wp-option'])) {
			$wp_option = $option['fw-storage']['wp-option'];
		} elseif (!empty($params['wp-option'])) {
			$wp_option = $params['wp-option'];
		}

		if ($wp_option) {
			return $wp_option;
		} else {
			return false;
		}
	}
}
