

document.getElementById("review_button").addEventListener('click',async ()=>{
 const file = document.getElementById('filename').value.trim();
 const code = document.getElementById('code').value;
 if (!file|| !code) {
    return alert("Enter filename and code!");
 }
try{
const response= await axios.post("http://localhost/AI_Review/Backend/review.php",{
              file: file ,code :code
              })
          
                console.log("Server response:", response.data);
                 const data = response.data;
                 const res = JSON.stringify(data, null, 2);
                 document.getElementById("output").textContent = res;
             
               } catch (error) {
                 console.error("Error", error);
  }
});
               
 