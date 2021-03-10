export default class Calculator {
    constructor(options = {}) {
        this.operatorButtons = options.operatorButtons;
        this.operandButtons = options.operandButtons;
        this.operationField = options.operationField;
        this.synthaxParserUrl = options.synthaxParserUrl;
        this.lastOperation = options.lastOperation;
        this.submitButton = options.submitButton;
    }

    bindEvents() {
        let that = this;

        this.operatorButtons.forEach(element => {
            element.addEventListener("click", function () {
                let currentValue = that.operationField.value;
                if (currentValue.length >= 1 && ['+', '-', '/', '*'].includes(currentValue.slice(-1))) {
                    that.operationField.value = currentValue.slice(0, -1) + this.value;
                } else {
                    that.operationField.value += this.value;
                }
            }, false);
        });

        this.operandButtons.forEach(element => {
            element.addEventListener("click", function () {
                that.operationField.value += this.value;
            }, false);
        });

        this.lastOperation.addEventListener("click", function () {
            this.clear();
        }.bind(this), false);

        this.submitButton.addEventListener("click", function () {
            this.parse();
        }.bind(this), false);
    }

    clear() {
        this.lastOperation.textContent = "";
    }

    parse() {
        let self = this;

        self.lastOperation.textContent = self.operationField.value + ' =';
        
        fetch(this.synthaxParserUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ "operation": self.operationField.value })
        }).then(function (response) {
            if (response.status != 200) {
                console.log('Looks like there was a problem. Status Code: ' + response.status); //TODO
                return;
            }
            response.json().then(function (data) {
                self.operationField.value = data.result;
            });
        })
            .catch(function (error) {
                console.log(error);
            });
    }

    init() {
        this.bindEvents();
    }
}