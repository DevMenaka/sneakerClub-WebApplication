const wrapper = document.querySelector('.wrapper');
const loginlink = document.querySelector('.login-link');
const registerlink = document.querySelector('.register-link');
const iconClose = document.querySelector('.icon-close');
const gotologin = document.querySelector('.goto-login');

const btnPopup = document.querySelector('.button-Login');

registerlink.addEventListener('click', ()=>{
    wrapper.classList.add('active');
});

loginlink.addEventListener('click', ()=>{
    wrapper.classList.remove('active');
});

gotologin.addEventListener('click', ()=>{
    wrapper.classList.remove('active-rw');
});

btnPopup.addEventListener('click', ()=>{
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=>{
    wrapper.classList.remove('active-popup');
});

var bm;

function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}
function changepwViwe() {
  var signUpBox = document.getElementById("fpw");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signUp() {

  var f = document.getElementById("f");
  var l = document.getElementById("l");
  var e = document.getElementById("e");
  var p = document.getElementById("p");

  var form = new FormData;
  form.append("f", f.value);
  form.append("l", l.value);
  form.append("e", e.value);
  form.append("p", p.value);


  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " success") {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msg").className = "bi bi-check2-circle fs-5";
        document.getElementById("alertdiv").className = "alert alert-success text-success bg-body border-0";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = t;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  }
  r.open("POST", "signUpProcess.php", true);
  r.send(form);

}

function signIn() {

  var email = document.getElementById("em");
  var password = document.getElementById("pw");
  var rememberme = document.getElementById("rme");

  var f = new FormData();

  f.append("e", email.value);
  f.append("p", password.value);
  f.append("r", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " success") {
        window.location = "home.php";
      } else {
        document.getElementById("alt").innerHTML = t;
      }
    }
  };


  r.open("POST", "signInprocess.php", true);
  r.send(f);

}

function uploadItemImage() {
  
  var img = document.getElementById("itemImage");

  img.onchange = function () {

    var file_qty = img.files.length;

    if (file_qty <= 6) {
      for (var x = 0; x < file_qty; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img" + x).src = url;
      }
    } else {
      alert("Please Select 6 Or less than 6 images.");
    }

  }

}

function addItem() {

  var sizeValue = document.getElementById("in1");

  alert(sizeValue);

  // var brand = document.getElementById("brand");
  // var type = document.getElementById("type");
  // var size = document.getElementById("size");
  // var colour = document.getElementById("colour");
  // var title = document.getElementById("title");
  // var description = document.getElementById("description");
  // var qty = document.getElementById("qty");
  // var price = document.getElementById("price");
  // var dfc = document.getElementById("dfc");
  // var dfo = document.getElementById("dfo");
  // var itemImage = document.getElementById("itemImage");

  // var f = new FormData();
  // f.append("b", brand.value);
  // f.append("t", type.value);
  // f.append("s", size.value);
  // f.append("c", colour.value);
  // f.append("ti", title.value);
  // f.append("d", description.value);
  // f.append("q", qty.value);
  // f.append("p", price.value);
  // f.append("dfc", dfc.value);
  // f.append("dfo", dfo.value);

  // var file_qty = itemImage.files.length;

  // for (var x = 0; x < file_qty; x++) {
  //   f.append("img" + x, itemImage.files[x]);
  // }

  // var r = new XMLHttpRequest();

  // r.onreadystatechange = function () {
  //   if (r.readyState == 4) {
  //     var t = r.responseText;
  //     alert(t)
  //     window.location.reload();
  //   }
  // }

  // r.open("POST", "additemprocess.php", true);
  // r.send(f);

}

var pm;

function pdModel(id) {

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t != "error") {
        var m = document.getElementById("productModel");
        pm = new bootstrap.Modal(m);
        pm.show();
        document.getElementById("mbody").innerHTML = t;
      } else {
        alert("Someting Went Wrong");
      }
    }
  };
  r.open("GET", "qukeView.php?pid=" + id, true);
  r.send()
}

function addToCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }

  r.open("GET", "addToCartProcess.php?id=" + id, true);
  r.send();
}

function addToWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }

  r.open("GET", "addToWatchListProcess.php?id=" + id, true);
  r.send();
}

function deletFromCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " 1") {
        alert("Item Is Removed")
        window.location.reload();
      } else {
        alert(t);
      }

    }
  }

  r.open("GET", "deletFromCartProcess.php?id=" + id, true);
  r.send();
}

function removeWachlist(id) {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " 1") {
        alert("Item Is Successfully Removed From WatchList");
        window.location.reload();
      } else {
        alert(t);
      }

    }
  }

  r.open("GET", "removeFromWatchlistProcess.php?id=" + id, true);
  r.send();
}

function adminlogin() {
  var admin = document.getElementById("adminLogin");

  var f = new FormData();
  f.append("adminemail", admin.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " success") {
        alert("Verification Code Send Your Email Please Check Your Inbox");
        var boxA = document.getElementById("boxA");
        var boxB = document.getElementById("boxB");

        boxA.classList.toggle("d-none");
        boxB.classList.toggle("d-none");
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "adminLoginProcess.php", true);
  r.send(f);
}

function adminverify() {
  var adminvcode = document.getElementById("admincode").value;

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == " success") {
        window.location = "adminPanel.php";
      } else {
        alert(t);
      }
    }
  }
  r.open("POST", "adminVerifyProcess.php?v=" + adminvcode, true);
  r.send();

}

function adminActive(e) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }
  r.open("GET", "changeAdminStatus.php?email=" + e, true);
  r.send();
}

var bm;

function adminModel() {
  var m = document.getElementById("addAdminModel");
  bm = new bootstrap.Modal(m);
  bm.show();
}

function sendAdminRequest() {
  var newAdminEmail = document.getElementById("newAdminEmail").value;
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == " Done") {
        alert("Request Send To New Admin");
        bm.hide();
      } else {
        alert(t);

      }
    }
  }
  r.open("GET", "adminRequestProcess.php?newAdminEmail=" + newAdminEmail, true);
  r.send();

}

function changeImage() {
  var viwe = document.getElementById("viweImage");
  var file = document.getElementById("profileimg");


  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    viwe.src = url;
  }
}

function updateAdminprofile(id) {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var image = document.getElementById("profileimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("e", email.value);

  if (image.files.length == 0) {

    var confirmation = confirm("Are you sure don't want to update Profile Image?");

    if (confirmation) {
      alert("you have select any image");
    }

  } else {
    f.append("image", image.files[0]);
  }


  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }

  r.open("POST", "updateAdminProfileProcess.php?id=" + id, true);
  r.send(f);

}

function changeItemStatus(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }
  r.open("GET", "changeItemStatus.php?id=" + id, true);
  r.send();
}

function RemoveItemFromPage(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " 1") {
        alert("Item Is Removed")
        window.location.reload();
      } else {
        alert(t);
      }

    }
  }

  r.open("GET", "removeItemFromPage.php?id=" + id, true);
  r.send();
}

function updateItems(id) {
  var title = document.getElementById("title");
  var qty = document.getElementById("qty");
  var dwc = document.getElementById("dfc");
  var doc = document.getElementById("dfo");
  var description = document.getElementById("description");
  var images = document.getElementById("itemImage");

  var f = new FormData();
  f.append("t", title.value);
  f.append("q", qty.value);
  f.append("dwc", dwc.value);
  f.append("doc", doc.value);
  f.append("d", description.value);

  var file_count = images.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("i" + x, images.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t = "Product has been updated!success" || "Product has been updated!Image Not Upload Or Invalid Image Count!") {
        alert("Item Is Successfully Updated !");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  }

  r.open("POST", "updateItems.php?id=" + id, true);
  r.send(f);

}

function checkValue(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 1 or more");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Maximum quntity achived");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");
  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quntity Has achived");
    input.value = qty;
  }
}

function qty_dec(qty) {
  var input = document.getElementById("qty_input");
  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("minimum quntity Has achived");
    input.value = 1;
  }
}

function review(reveiw) {

  var comment = document.getElementById("review").value;
  var email = reveiw.email;
  var id = reveiw.pid;
  var status = reveiw.status;

  var form = new FormData();
  form.append("id", id);
  form.append("email", email);
  form.append("status", status);
  form.append("comment", comment);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == " success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "review.php", true);
  r.send(form);

}

function signout() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {

    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "index.php";
      } else {
        alert(t);
      }
    }

  };

  r.open("GET", "signoutprocess.php", true);
  r.send();

}

function basicSearch() {
 
    var text = document.getElementById("basic_search_text");

    var f = new FormData();
    f.append("t", text.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        var t = r.responseText;
        document.getElementById("bscearch_results").innerHTML = t;
      }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
 
}

function saveCustermerDetails(ijson) {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var mobile = document.getElementById("mobile").value;
  var address1 = document.getElementById("address1").value;
  var address2 = document.getElementById("address2").value;
  var pcode = document.getElementById("pcode").value;
  var province = document.getElementById("province").value;
  var district = document.getElementById("district").value;
  var city = document.getElementById("city").value;

  var f = new FormData();
  f.append("fname", fname);
  f.append("lname", lname);
  f.append("mobile", mobile);
  f.append("address1", address1);
  f.append("address2", address2);
  f.append("province", province);
  f.append("distirict", district);
  f.append("city", city);
  f.append("pcode", pcode);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " success") {

        var obj = {
          "pid": ijson.pid,
          "qty": ijson.qty,
        }
        var json = JSON.stringify(obj);

        window.location = "placeOrder.php?idata=" + json;
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "costermerDetails.php", true);
  r.send(f);
}

function coustermerForm(id) {

  var pid = id

  if (pid == 0) {
    var txt = "Plese Sign In First !!!";
    document.getElementById("txt").innerHTML = txt
  } else {

    var qty = document.getElementById("qty_input").value;
    var obj = {
      "pid": pid,
      "qty": qty,
    }
    var json = JSON.stringify(obj);
    window.location = "checkout.php?data=" + json;
  }
}

function conform(cusdata) {

  var f = new FormData();
  f.append("iid", cusdata.pid);
  f.append("oid", cusdata.orderId);
  f.append("date", cusdata.date_time);
  f.append("total", cusdata.total);
  f.append("qty", cusdata.qty);
  f.append("orderId", cusdata.orderId);
  f.append("user", cusdata.user);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == 1) {
        setTimeout(goToinvoice, 3000)
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "saveInvoice.php", true);
  r.send(f);

  function goToinvoice() {
    window.location = "invoice.php?id=" + cusdata.orderId;
  }

}
function printInvoice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

function itemView(oid) {
  alert(oid);
}

function searchOrder(event) {
  var keyCode = event.which
  if (keyCode == 13) {
    var oid = document.getElementById("search_order").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        t = r.responseText;
        if (t == 0) {
          alert("Plese Enter Order Id !!!");
        } else if (t == 1) {
          alert("There is no order under that number.");
        } else {
          document.getElementById("orderResultss").innerHTML = t;
        }
      }
    }

    r.open("GET", "findOrder.php?oid=" + oid, true);
    r.send();
  }
}

function searchManageItem(event) {

  var keyCode = event.which
  if (keyCode == 13) {
    var keyword = document.getElementById("search_manageItem").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
      if (r.readyState == 4) {
        t = r.responseText;
        if (t == 0) {
          alert("Enter Valid Keyword");
        } else {
          document.getElementById("findItem").innerHTML = t;
        }
      }
    }

    r.open("GET", "findItems.php?keyWord=" + keyword, true);
    r.send();
  }

}

function changeMameberStatus(email) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }
  r.open("GET", "changeMemberStatus.php?email=" + email, true);
  r.send();
}

function removeMameber(email) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }
  r.open("GET", "removeMember.php?email=" + email, true);
  r.send();
}

function removeAdmin(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  }
  r.open("GET", "removeAdmin.php?id=" + id, true);
  r.send();
}

function Adminsignout() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {

    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "adminLogin.php";
      } else {
        alert(t);
      }
    }

  };

  r.open("GET", "adminSignoutprocess.php", true);
  r.send();

}

function advancedSearch() {
  var title = document.getElementById("title").value;
  var brand = document.getElementById("brand").value;
  var type = document.getElementById("type").value;
  var size = document.getElementById("size").value;
  var colour = document.getElementById("colour").value;
  var priceF = document.getElementById("priceF").value;
  var priceT = document.getElementById("priceT").value;
  var sortId = document.getElementById("sortId").value;

  var f = new FormData();
  f.append("title", title);
  f.append("brand", brand);
  f.append("type", type);
  f.append("size", size);
  f.append("colour", colour);
  f.append("priceF", priceF);
  f.append("priceT", priceT);
  f.append("sortId", sortId);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("POST", "advancedSearchprocess.php", true);
  r.send(f);

}

function requestPwReset() {
  var email = document.getElementById("em").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == " Success") {
        alert("Verification Code has Sent to your email. Plese Check your inbox");
        // changepwViwe();
          wrapper.classList.add('active-rw');
      } else {
        alert(t);
      }
    }
  };


  r.open("GET", "forgotPasswordProcess.php?e=" + email, true);
  r.send();

}



function newPasswordUpdate() {

  var nPw = document.getElementById("nPw").value;
  var cPw = document.getElementById("cPw").value;
  var vc = document.getElementById("vcode").value;

  var f = new FormData();
  f.append("nPw", nPw);
  f.append("cPw", cPw);
  f.append("vc", vc);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == " success"){
          alert("Your Password Is Successfully Reset");
      }else{
        alert(t);
      }
    }
  }

  r.open("POST", "passwordRest.php", true);
  r.send(f);
}

function textLenght(){
  if (document.getElementById("review").value.length>=250) {
    alert("Maximum Caracter Lenth 250");
}

}

// function buynow(orderData){
//   var pid = orderData.pid;
//   var qty = orderData.qty;
//   var title = orderData.title;
//   var total = orderData.total;
//   var user = orderData.user;
//   var orderId = orderData.orderId;

//   var obj = 
//   {"pid":pid,
//   "qty":qty,
//   "title":title,
//   "total":total,
//   "user":user,
//   "orderId":orderId}

//   var r = new XMLHttpRequest();
  
//   r.onreadystatechange = function(){
//     if (r.readyState==4 && r.status==200) {
//         var t = r.responseText;
//         alert(t);
//     }
//   }

//   r.open("POST","create-checkout-session.php",true);
//   r.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//   r.send("data="+JSON.stringify(obj));
// }