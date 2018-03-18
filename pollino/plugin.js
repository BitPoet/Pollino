CKEDITOR.plugins.add("pollino", {
    init: function(editor) {
   		new CKEDITOR.plugins.pollino(editor);
    }
});

CKEDITOR.plugins.pollino = function(editor) {

	// Add the link and unlink buttons.
	editor.addCommand('pollino', {
		exec: loadIframePollPicker
	}); 
	
	if ( editor.ui.addButton ) {

		var iconUrl = '' + ProcessWire.config.pwpollino.url + (CKEDITOR.env.hidpi ? 'images/hidpi/pollino.png' : 'images/pollino.png');

		editor.ui.addButton( 'Pollino', {
			label: ProcessWire.config.pwpollino.label,
			command: 'pollino',
			toolbar: 'Pollino,10',
			icon: iconUrl
		});

	}

	function loadIframePollPicker(editor) {
		
		var insertPollLabel = ProcessWire.config.pwpollino.label;
		var cancelLabel = ProcessWire.config.pwpollino.cancel;
		//var insertPollLabel = 'Insert Poll';
		//var cancelLabel = 'Cancel';

		// settings for modal window
		var modalSettings = {
			title: "<i class='fa fa-link'></i> " + insertPollLabel,
			open: function() {
				if(jQuery(".cke_maximized").length > 0) {
					// the following is required when CKE is maximized to make sure dialog is on top of it
					jQuery('.ui-dialog').css('z-index', 9999);
					jQuery('.ui-widget-overlay').css('z-index', 9998);
				}
			},
			buttons: [ {
				'class': "pw_poll_submit_insert", 
				'html': "<i class='fa fa-link'></i> " + insertPollLabel,
				'click': clickInsert
			}, {
				'html': "<i class='fa fa-times-circle'></i> " + cancelLabel,
				'click': function() { $iframe.dialog("close"); },
				'class': 'ui-priority-secondary'
				}
			]
		};
		
		var $iframe;
		
		function clickInsert() {
			var $i = $iframe.contents();
			var $sel = jQuery($i).find('select#poll option:selected');
			if($sel) {
				var poll = $sel.val();
				editor.insertText('##POLL:' + poll + '##');
			}
			$iframe.dialog("close");
		}

		var modalUrl = ProcessWire.config.urls.admin + 'pwpollino/';
		
		var $iframe = pwModalWindow(modalUrl, modalSettings, 'medium'); 

	}
}
