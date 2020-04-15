
function testPhone(user)
{
    
    var reg = /^[0-9]+$/;
    if(reg.test(user))
        return true;
    return false;
};
function testString(user)
{
    
    var reg = /^[a-zA-Z]+$/;
    if(reg.test(user))
        return true;
    return false;
};
function testMail()
{
    var mail = document.getElementById('mail').value;
    var reg = /^(\w[-._+\w]*\w@\w[-._\w]*\w\.\w{2,3})$/;
    if(reg.test(mail))
        return true;
    return false;
};
function testPass()
{
    var pass = document.getElementById('pass').value;
    var reg = /^[a-zA-Z0-9]{1,8}$/;
    if(reg.test(pass))
        return true;
    return false;
}
function testVal()
{ 
    
    var check= document.querySelector('.tac');
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var pass = document.getElementById('pass').value;
    var cfpass = document.getElementById('cfPass').value;
    var f = 0;
    var frm = document.frmRegister;
    var user = document.getElementById('user').value;
    nof_user = document.getElementById('nofUser');
    nof_mail = document.getElementById('nofMail');
    nof_pass = document.getElementById('nofPass');
    nof_name = document.getElementById('nofName');
    nof_gender = document.getElementById('nofGender');
    nof_check = document.getElementById('noftac');
 
//testUser
    if(testString(user)==false)
    {
        nof_user.innerHTML = 'Please re-check your Username !!!!';
        f = 1;
    }
    else
        nof_user.innerHTML = '';
//test mail
    if(testMail()==false)
    {
        f = 1;
        nof_mail.innerHTML = 'Please re-check your Email !!!!';
    }
    else
        nof_mail.innerHTML = '';
// /test pass
    if(testPass()==false)
    {
        f = 1;
        nof_pass.innerHTML = 'Please re-check your Pass !!!!';
    }
       
    else
        nof_pass.innerHTML = '';
// test confirm
    
    if(pass != cfpass || cfpass == '')
    {
         nof_pass.innerHTML = 'Please re-check your confirm Pass !!!!';
         f = 1;
    }
       
    else
        nof_pass.innerHTML = '';
// test first name and Last Name
    
    if(testString(fname) != true)
    {
        f = 1;
        nof_name.innerHTML = 'Please re-check your  First name !!!! ';
    }
        
    if(testString(lname) != true)
    {
        f = 1;
        nof_name.innerHTML = 'Please re-check your  Last name !!!! ';
    }
        
    else
        nof_name.innerHTML = '';
// test gender
    var gender = document.querySelector('#gende').value;
    if(gender == '')
    {
        f = 1;
        nof_gender.innerHTML = 'Please re-check your Gender!!!! ';
    }
    else
        nof_gender.innerHTML = '';
// test check
    
    if(check.checked == false )
    {
        f = 1;
        nof_check.innerHTML = 'Please re-check your terms and Conditions !!!! ';
    }
        
    else{
        nof_check.innerHTML = '';
    }
    // alert(f);
    if(f == 0)
    {
        frm.submit();
    }
        
        
    
}