function generateID(){
    var firstDigit = Math.floor((Math.random() * 10));
    var secondDigit = Math.floor((Math.random() * 10))* 10;
    var thirdDigit = Math.floor((Math.random() * 10)) * 100;
    var fourthDigit = Math.floor((Math.random() * 10)) * 1000;
    
    var roomID = firstDigit + secondDigit + thirdDigit + fourthDigit;
    document.getElementById('orderID').value = roomID;
}
