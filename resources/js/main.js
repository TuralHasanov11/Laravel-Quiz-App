let resetSearchBtn = document.getElementById('resetSearch');
resetSearchBtn.addEventListener('click',(e)=>{
    document.querySelector('input#title').value='';
    document.querySelector('select#status').selectedIndex=0;
});