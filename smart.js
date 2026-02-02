function weluser(){
    confirm("YOU WANT TO CONTINUE ??")
}
function showAlert(){
    alert("Welcome to MSR Hospitals smart Healthcare Dashboard")
}
function showmsg(){
    alert("Appointment booked successfullyy!")
}
function submitForm(){
    var name =document.getElementById("name").value;
    var age =document.getElementById("age").value;
    var ADATE =document.getElementById("ADATE").value;
    var ATIME =document.getElementById("ATIME").value;
    var message="Mr/ms: "+ name + " reserved an Appointment on " + ADATE ;
    document.getElementById("result").innerHTML=message;
} 

document.addEventListener("DOMContentLoaded",() => {
    const cells=document.querySelectorAll("#ptabstd");
    cells.forEach(cell => {
        cell.addEventListener("click",() => {
            
            cell.style.backgroundColor="#d1f7c4";
        });
    });
});