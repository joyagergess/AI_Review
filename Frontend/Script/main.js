

document.getElementById("review_button").addEventListener('click',async ()=>{
 const file = document.getElementById('filename').value.trim();
 const code = document.getElementById('code').value;

 if (!file|| !code) {
    return alert("Enter filename and code!");
 }
document.getElementById('output').textContent= file + code;
});