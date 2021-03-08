/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import Calculator from './js/Calculator.js';

var calculator = new Calculator({
    operators : document.querySelectorAll('.operator-button'),
    operands : document.querySelectorAll('.operand-button'),
    operationField : document.getElementById("calculator_operation"),
    parseUrl : document.getElementById("parser_path").getAttribute("data-path"),
    lastOperation : document.getElementById("last-operation"),
    submitButton : document.getElementById('submit')
});

calculator.init();

// start the Stimulus application
import './bootstrap';
