 window.onload = function() {
    let operationField = document.getElementById("calculator_operation");
    let operandButtons = document.querySelectorAll(".operand-button");
      for(let i = 0; i < operandButtons.length; i++ ) {
        operandButtons[i].addEventListener("click",function() {     
            operand = this.value;
            operationField.value += operand;   
     },false);   
    } 
    let operatorButtons = document.querySelectorAll(".operator-button");
    for (let i = 0; i < operatorButtons.length; i++ ) {
        operatorButtons[i].addEventListener("click",function() {
            operator = this.value;
            currentValue = operationField.value;
            if(currentValue.length >= 1 && ['+','-','/','*'].includes(currentValue.slice(-1))){
                 operationField.value = currentValue.slice(0, -1) + operator;
            } else {
                operationField.value += this.value;  
            }
            
        },false);
    }

    var sendForm = function() {
        let operation = document.getElementById("calculator_operation");
        let baseUrl = document.getElementById("parser_path").getAttribute("data-path");
        fetch(baseUrl, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({"operation": operation.value})
        }).then(function(response) {  
            if (response.status != 200) {
                    console.log('Looks like there was a problem. Status Code: ' + response.status);
                return;
            }
            response.json().then(function(data) {
                operation.value = data.result; 
            });   
        })
        .catch(function(error) {
            console.log(error);
        }); 
    };

    var submitButton = document.getElementById('submit');
    submitButton.addEventListener("click", sendForm);
}