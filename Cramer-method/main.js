document.addEventListener('DOMContentLoaded', function() { 
    const form = document.createElement('form'); 
    this.body.append(form);
    const resultFrom = document.createElement('form');
    resultFrom.setAttribute('class', 'resultForm');
    this.body.append(resultFrom);

    const cfBtn = createForm();
    const resultBtn = createResultForm();

    cfBtn.addEventListener('click', function() {
        const matrix = fillInput();
        resultBtn.addEventListener('click', function() {
            const answer = methodCramer(matrix.resultMatrix, matrix.resultArr);
            for(let i = 1; i <= 3; i++) {
                const input = document.getElementById(`inputResult${i}`);
                switch(i) {
                    case 1: input.setAttribute('value', `${answer.x1}`); continue;
                    case 2: input.setAttribute('value', `${answer.x2}`); continue;
                    case 3: input.setAttribute('value', `${answer.x3}`); continue;
                }
            }
             
        })
    })

    function createForm() { 
        let k = 1;
        for (let i = 1; i <= 12; i++) { 
            const label = document.createElement('label');
            if (k === 4) {
                k = 1;
                label.innerHTML = ` = `;
                const input = document.createElement('input'); 
                input.setAttribute('id', `input${i}`);
                form.append(label); 
                form.append(input); 
                continue;
            }
            label.innerHTML = `X${k} `;
            const input = document.createElement('input');
            input.setAttribute('id', `input${i}`);
            form.append(label); 
            form.append(input); 
            k++;
        } 
        const btn = document.createElement('input');
        btn.setAttribute('type', 'button');
        btn.setAttribute('value', 'Сгенерировать коэффициенты');
        form.append(btn);
        return btn;
    }

    function fillInput() {
        let resultMatrix = [];
        let resultArr = [];
        let tempArr = [];
        let k = 0;
        for (let i = 1; i <= 12; i++) {
            if (k === 3) {
                resultMatrix.push(tempArr);
                tempArr = [];
                k = 0;
                const input = document.getElementById(`input${i}`);
                let random = randomNumber();
                input.setAttribute('value', `${random}`);
                resultArr.push(random);
                continue;
            }
            const input = document.getElementById(`input${i}`);
            let random = randomNumber();
            input.setAttribute('value', `${random}`);
            tempArr.push(random);
            k++;
        }
        return {resultMatrix, resultArr};
    }

    function createResultForm() {
        for (let i = 1; i <= 3; i++) {
            const label = document.createElement('label');
            label.innerHTML = `X${i}`;
            resultFrom.append(label);
            const resultInput = document.createElement('input');
            resultInput.setAttribute('id', `inputResult${i}`);
            resultFrom.append(resultInput);
        }
        const btn = document.createElement('input');
        btn.setAttribute('type', 'button');
        btn.setAttribute('value', 'Показать ответ');
        resultFrom.append(btn);
        return btn;
    }

    function randomNumber() {
        return Math.round(Math.random() * 100);
    }

    function findDether(arr) { 
        let d = (arr[0][0]*arr[1][1]*arr[2][2] + arr[0][2]*arr[1][0]*arr[2][1] + 
        arr[0][1]*arr[1][2]*arr[2][0]) - (arr[0][2]*arr[1][1]*arr[2][0] + 
        arr[0][0]*arr[1][2]*arr[2][1] + arr[0][1]*arr[1][0]*arr[2][2]) 
        if (d !== 0) { 
            return d; 
        } else { 
            return 0; 
        } 
    } 

    function cloneArray(arr) {
        let resultArr = [];
        let tempArr = [];
        for (const element of arr) {
            for (const value of element) {
                tempArr.push(value);
            }
            resultArr.push(tempArr);
            tempArr = [];
        }
        return resultArr;
    }
 
    function methodCramer(arr, secArr) { 
        let x1, x2, x3;
        if (findDether(arr) !== 0) { 
            for (let i = 0; i <= 2; i++){ 
                let tempArr = cloneArray(arr);
                switch(i) { 
                    case 0: { 
                        tempArr[0][0] = secArr[0]; 
                        tempArr[1][0] = secArr[1]; 
                        tempArr[2][0] = secArr[2]; 
                        let tempDether = findDether(tempArr); 
                        x1 = tempDether / findDether(arr); 
                        continue;
                    }  
                    case 1: { 
                        tempArr[0][1] = secArr[0]; 
                        tempArr[1][1] = secArr[1]; 
                        tempArr[2][1] = secArr[2]; 
                        let tempDether = findDether(tempArr); 
                        x2 = tempDether / findDether(arr); 
                        continue;
                    } 
                    case 2: { 
                        tempArr[0][2] = secArr[0]; 
                        tempArr[1][2] = secArr[1]; 
                        tempArr[2][2] = secArr[2]; 
                        let tempDether = findDether(tempArr); 
                        x3 = tempDether / findDether(arr); 
                        continue;
                    } 
                }  
            } 
             
        } 
        return {x1, x2, x3};
    } 
})