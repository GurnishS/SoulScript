const profile=document.getElementById('profile');
const dropdown=document.getElementById('dropdown');
const button=document.getElementById('logoutbutton');
const card=document.getElementsByClassName('card');
const para=profile.firstElementChild;

const width=profile.offsetLeft-240;
const height=profile.offsetTop+60;
dropdown.style.display='none';
dropdown.style.left=width+'px';
dropdown.style.top=height+'px';

window.addEventListener('resize', () => {
    const width=profile.offsetLeft-130;
    const height=profile.offsetTop+60;
    dropdown.style.left=width+'px';
    dropdown.style.top=height+'px';
});

profile.addEventListener('click',()=>{
    if(dropdown.style.display==='none'){
        dropdown.style.display='flex';
    }
    else{
        dropdown.style.display='none';
    }
});

button.addEventListener('click',()=>{
    window.location.href = 'logout.php';
});

profile.addEventListener('blur',()=>{
    dropdown.style.display='none';
});

window.addEventListener('click',(event)=>{
    if(event.target!==profile && event.target!==para ){
        dropdown.style.display='none';
    }
});

for (let i = 0; i < card.length; i++) {
    card[i].addEventListener('click', () => {     
        document.getElementById('id03').style.display = 'block';
        const inp_title=document.getElementById('inp-title');
        const inp_body=document.getElementById('inp-body');
        const inp_hidden=document.getElementsByName('hide');
        inp_hidden[0].value=i;
        inp_body.value=card[i].firstElementChild.textContent;
        inp_title.value=card[i].lastElementChild.textContent;
    });
    document.getElementById('note-editor').action = 'note_update.php';   
}

function reset_form() {
    const del_button=document.getElementById('deletebutton');
    del_button.disabled = true;
    const inp_title=document.getElementById('inp-title');
    const inp_body=document.getElementById('inp-body');
    
    inp_title.value="";
    inp_body.value="";
    
    document.getElementById('note-editor').action = 'save_note.php';
}