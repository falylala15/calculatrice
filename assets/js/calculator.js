export default class Calculator {
    constructor(options = {}) {
        Object.assign(this, {
            operands: '.operand-button',
            operators: '.operation-button',
            operationField: '',
            parseUrl: '/calculate'
        }, options);
    }

    bindEvents() {
        let that = this;
        this.operators.forEach(element => {
            element.addEventListener("click", function () {
                let currentValue = that.operationField.value;
                if (currentValue.length >= 1 && ['+', '-', '/', '*'].includes(currentValue.slice(-1))) {
                    that.operationField.value = currentValue.slice(0, -1) + this.value;
                } else {
                    that.operationField.value += this.value;
                }
            }, false);
        });

        this.operands.forEach(element => {
            element.addEventListener("click", function () {
                that.operationField.value += this.value;
            }, false);
        });

        this.lastOperation.addEventListener("click", this.clear, false);
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
        fetch(this.parseUrl, {
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