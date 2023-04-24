/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import $ from 'jquery'



$(document).ready(function () {

    function updateFields(triggerField){
    
        let showValue = triggerField.data('show-value');
        let value = triggerField.val();
        let targetClass = triggerField.data('fields');
        let elements = $('.' + targetClass);
        console.log(targetClass, elements);
        if (value == showValue && triggerField.is(":visible")) {
            elements.each(function (i, j) {
                $(j).parent().show();
            });
        } else {
            elements.each(function (i, j) {
                $(j).parent().hide();
            });
        }
    }

    $('.field-trigger').each(function(i,j){
        updateFields($(j));
    })

    $('.field-trigger').change(function () {
        updateFields($(this));
    })

    
})

