jQuery(document).ready(function($) {
    
        // set context to customizer panel outside iframe site content is in
        var panel = $('html', window.parent.document);
    
        addLayoutThumbnails();
        addProlabel();
    
        // replaces radio buttons with images
        function addLayoutThumbnails() {
    
            // get layout inputs
            var layoutInputs = panel.find('#customize-control-layout').find('input');
    
            // add the appropriate image to each label
            layoutInputs.each( function() {
    
                $(this).next().css('background-image', 'url("' + ct_chosen_pro_objectL10n.CHOSEN_PRO_URL + 'assets/images/' + $(this).val() + '.png")');
    
                // add initial 'selected' class
                if ( $(this).prop('checked') ) {
                    $(this).next().addClass('selected');
                }
            });
    
            // watch for change of inputs (layouts)
            panel.on('click', '#customize-control-layout input', function () {
                addSelectedLayoutClass(layoutInputs, $(this));
            });
        }
    
        // add the 'selected' class when a new input is selected
        function addSelectedLayoutClass(inputs, target) {
    
            // remove 'selected' class from all labels
            inputs.next().removeClass('selected');
    
            // apply 'selected' class to :checked input
            if ( target.prop('checked') ) {
                target.next().addClass('selected');
            }
        }
    
        // label Unlimited Pro customizer sections
        function addProlabel() {
    
            // to prevent running more than once per session
            if (!panel.hasClass('pro-labels')) {
    
                var sections = [ 'header_image', 'colors', 'layout', 'fonts', 'featured_image_size', 'display', 'fixed_menu', 'footer_text', 'spacing' ];
    
                var proLabel = '<span class="pro-label">PRO</span>';
    
                $.each(sections, function (key, value) {
                    if (value == 'colors') {
                        panel.find('#accordion-panel-ct_chosen_pro_' + value + '_panel').children('h3').append(proLabel);
                    }
                    else {
                        panel.find('#accordion-section-ct_chosen_pro_' + value).children('h3').append(proLabel);
                    }
                });
                panel.addClass('pro-labels');
            }
        }
    });