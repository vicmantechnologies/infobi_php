function GetUsers() {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState===4 && this.status===200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
                $.ajax({  
                     url:"../php/get_user.php",  
                     method:"POST",  
                     success:function(data){  
                          $('#usuarios').html(data);
                     }  
                });
}

function EditUser(id) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
                $.ajax({  
                     url:"../php/Editar_usuario.php?q="+id,  
                     method:"POST",  
                     success:function(data){  
                          $('#cuerpo').html(data);
                          $('#editModal').modal('show');
                     }  
                });
}
  function DeleteUser(id) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  var r = confirm("Estas seguro de que quieres eliminar?");
  if (r == true) {
                $.ajax({  
                     url:"../php/Eli_usuario.php?q="+id,  
                     method:"POST",  
                     success:function(data){  
                          alert('Eliminado correctamente');
                          $('#usuarios').load("../php/get_user.php");
                     }  
                });
  }
}
