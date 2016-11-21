var my_editor = null;
(function() {
	tinymce.create('tinymce.plugins.Vooplayer', {
		init : function(ed, url) {
			url = url.replace("/js","");
			my_editor = ed;
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			/*ed.addCommand('mceExample', function() {
					ed.windowManager.open({
							file : url + '/test.php',
							width : 320 + ed.getLang('example.delta_width', 0),
							height : 120 + ed.getLang('example.delta_height', 0),
							inline : 1
					}, {
							plugin_url : url, // Plugin absolute URL
							some_custom_arg : 'custom arg', // Custom argument
							editor_id : tinyMCE.selectedInstance.editorId
					});
			});*/

			ed.addButton('vooplayer', {
				title : 'Vooplayer Shortcode',
				image : url+'/images/large_icon.jpg',
				onclick : function() {
					idPattern = /(?:(?:[^v]+)+v.)?([^&=]{11})(?=&|$)/;
					ed.windowManager.open({
							title: 'Vooplayer Shortcode',
							file : ajaxurl + '?action=voo_videolist',
							width : 750,
							height : 400 ,
							inline : 1
					});
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Vooplayer",
				author : 'Vooplayer',
				authorurl : 'https://www.vooplayer.com',
				infourl : 'https://www.vooplayer.com',
				version : "3.0"
			};
		}
	});
	tinymce.PluginManager.add('vooplayer', tinymce.plugins.Vooplayer);
})();
