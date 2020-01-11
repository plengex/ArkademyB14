function randomize(param){
    let array = [];

    for (let i = 0; array.length < param; i++){
        let randomNum = Math.floor(Math.random() * 10) + 1;
        if (randomNum % 2 == 1){
            array.push(randomNum);
        }
    }

    let sum = 0;
    for (let j = 0; j < array.length; j++){
        sum += array[j];
    }

    return `array   : [${array}]
            sum     : ${sum}`;
}