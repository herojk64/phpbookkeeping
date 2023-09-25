const homePath = "/index.php";
let loginForm = document.getElementById("form_login");
if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let usernameError = document.getElementById("usernameError");
    let passwordError = document.getElementById("passwordError");
    let errorDisp = document.getElementById("errorDisp");
    if (
      username.length === 0 ||
      username === null ||
      username === undefined ||
      username === "undefined"
    ) {
      usernameError.innerHTML = "Fields cannot be empty";
      return;
    } else {
      usernameError.innerHTML = "";
    }
    if (
      password.length === 0 ||
      password === null ||
      password === undefined ||
      password === "undefined"
    ) {
      passwordError.innerHTML = "Fields cannot be empty";
      return;
    } else {
      passwordError.innerHTML = "";
    }

    let response = await login(username, password);
    if (response && response.success) {
      window.alert("Login successful!");
      window.location.href = homePath;
    } else {
      errorDisp.innerHTML = "Invalid username or password";
    }
  });
}

let signUpForm = document.getElementById("form_signup");
if (signUpForm) {
  let usernameError = document.getElementById("usernameError");

  document.getElementById("username").addEventListener("change", async (e) => {
    let response = await checkUsernameExists(e.target.value);
    if (response.exists) {
      usernameError.innerHTML = `Username alreay exists`;
    } else {
      usernameError.innerHTML = ``;
    }
  });
  signUpForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let cpassword = document.getElementById("cpassword").value;
    let phno = document.getElementById("phno").value;

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let usernameError = document.getElementById("usernameError");
    let passwordError = document.getElementById("passwordError");
    let cpasswordError = document.getElementById("cpasswordError");
    let phnoError = document.getElementById("phnoError");

    let errorDisp = document.getElementById("errorDisp");
    if (
      name.length === 0 ||
      name === null ||
      name === undefined ||
      name === "undefined"
    ) {
      nameError.innerHTML = "Fields cannot be empty";
      return;
    }

    if (
      email.length === 0 ||
      email === null ||
      email === undefined ||
      email === "undefined"
    ) {
      emailError.innerHTML = "Fields cannot be empty";
      return;
    }

    let validEmail = ["gmail.com", "outlook.com", "hotmail.com"];
    let emailType = email.split("@");
    if (!validEmail.includes(emailType[1])) {
      emailError.innerHTML = "Invalid email";
      return;
    }

    if (
      username.length === 0 ||
      username === null ||
      username === undefined ||
      username === "undefined"
    ) {
      usernameError.innerHTML = "Fields cannot be empty";
      return;
    }
    if (
      password.length < 6 ||
      password === null ||
      password === undefined ||
      password === "undefined"
    ) {
      passwordError.innerHTML = "Fields cannot be empty";
      return;
    }
    if (
      cpassword.length < 6 ||
      cpassword === null ||
      cpassword === undefined ||
      cpassword === "undefined"
    ) {
      cpasswordError.innerHTML = "Fields cannot be empty";
      return;
    }
    if (cpassword !== password) {
      passwordError.innerHTML = "Passwords do not match";
      return;
    }
    if (
      phno.length === 0 ||
      phno === null ||
      phno === undefined ||
      phno === "undefined"
    ) {
      phnoError.innerHTML = "Fields cannot be empty";
      return;
    }

    if (phno.length != 10) {
      phnoError.innerHTML = "Invalid phone number";
      return;
    }

    let response = await signup(name, email, username, password, phno);
    if (response && response.success) {
      window.alert("User register successful!");
      window.location.href = homePath;
    } else {
      errorDisp.innerHTML = "Invalid username or password";
    }
  });
}

let form_addBook = document.getElementById("form_add_book");

function formAddBookError(type, data) {
  var nameError = document.getElementById("nameError");
  var writterNameError = document.getElementById("writterError");
  var descriptionError = document.getElementById("descriptionError");
  var avatarError = document.getElementById("avatarError");
  var bookError = document.getElementById("bookError");
  if (type === "create") {
    console.log("wew");
    nameError.innerHTML = ``;
    writterNameError.innerHTML = ``;
    descriptionError.innerHTML = ``;
    avatarError.innerHTML = ``;
    bookError.innerHTML = ``;
    if (data.name && data.name.length === 0) {
      nameError.innerHTML = `Name cannot be empty`;
      return false;
    }
    if (data.writterName && data.writterName.length === 0) {
      writterNameError.innerHTML = `Writter name cannot be empty`;
      return false;
    }
    if (data.description && data.description.length === 0) {
      descriptionError.innerHTML = `Description cannot be empty`;
      return false;
    }

    if (data.avatar) {
      const acceptedFiles = ["image/jpeg", "image/jpg", "image/png"];
      if (!acceptedFiles.includes(data.avatar.type)) {
        avatarError.innerHTML = `Please provide valid file`;
        return false;
      }
    } else {
      avatarError.innerHTML = `Please provide the avatar`;
      return false;
    }

    if (data.book) {
      const acceptedBookFiles = ["application/pdf"];
      if (!acceptedBookFiles.includes(data.book.type)) {
        bookError.innerHTML = `Please provide valid file`;
        return false;
      }
    } else {
      bookError.innerHTML = `Please provide the book file`;
      return false;
    }

    return data;
  }

  return data;
}

function getDataFormAddBook(formType) {
  var name = document.getElementById("name").value;
  var writterName = document.getElementById("writter_name").value;
  var description = document.getElementById("description").value;
  var avatar = document.getElementById("avatar").files[0];
  var book = document.getElementById("book_file").files[0];

  var dat = {
    name,
    writterName,
    description,
    avatar,
    book,
  };
  let response = formAddBookError(formType, dat);

  return response;
}

if (form_addBook) {
  form_addBook.addEventListener("submit", async (e) => {
    e.preventDefault();
    let data = getDataFormAddBook("create");
    if (data) {
      let response = await addBooks(data);
      if (response && response.success) {
        alert(response.message);
        window.location.reload();
      } else {
        alert("Error creating the books.");
      }
    }
  });
}

//this is for admin table
var admin_table_list = document.getElementById("admin_book_list");

async function deleteBtnFunction(id) {
  if (window.confirm("Are you sure you want to delete this data")) {
    let response = await deleteBooks(id);
    if (response && response.success) {
      window.alert(response.message);
      window.location.reload();
    } else {
      window.alert("Error deleteing the data");
    }
  }
}

function setTableDataForAdmin(dat) {
  let admin_table_body = document.getElementById("admin_book_body");

  admin_table_body.innerHTML = "";
  dat.map((e, index) => {
    admin_table_body.innerHTML += `
    <tr>
<th scope="row">${index + 1}</th>
<td>${e.name}</td>
<td>${e.writer}</td>
<td>${e.description}</td>
<td><img src="./assets/${
      e.avatar
    }" class="img-thumbnail" style="height:100px;width:100px;" alt=""/></td>
<td>
<a href="./admin.php?edit=${
      e.id
    }"><button class="btn btn-primary bg-primary">Edit</button></a>
<button class="btn btn-danger bg-danger" onclick="deleteBtnFunction(${
      e.id
    })">Delete</button>
</td>
</tr>
    `;
  });
}

async function setAdminTableData() {
  let admin_table_body = document.getElementById("admin_book_body");
  if (admin_table_body) {
    admin_table_body.innerHTML = ``;
    let response = await getAllBooksData();
    if (response) {
      setTableDataForAdmin(response);
    }
  }
}

if (admin_table_list) {
  var search_bar = document.getElementById("search_book");
  search_bar.addEventListener("change", async (e) => {
    let response = await searchBooks(e.target.value);
    if (response && !response.success) {
      setTableDataForAdmin(response);
    }
  });
  setAdminTableData();
}


let client_book_main = document.getElementById("client_book_side");
function setClientBookData(datt){
  client_book_main.innerHTML = ``;
  datt.map((dat)=>{
    client_book_main.innerHTML += `
    <div class="col-6 col-lg-2 p-2 mb-3 d-flex align-items-stretch">
    <div class="card">
    <img src="/assets/${dat.avatar}" class="card-img-top ratio ratio-4x3 w-100" alt="">
    <div class="card-body">
  <h5 class="card-title">${dat.name}</h5>
  <p class="card-text">${dat.description.length>20?dat.split(20)[0]:dat.description}</p>
  <a href="/bookdetail.php?id=${dat.id}" class="btn btn-primary d-block w-100">Read Now</a>
</div>
</div>
    </div>
    `;
  });
}
if(client_book_main){
  var search_bar = document.getElementById("search");
  search_bar.addEventListener("change",(e)=>{
    searchBooks(e.target.value).then((e)=>{
      setClientBookData(e);
    })
  })

  getAllBooksData().then((e)=>{
    console.log(e);
    setClientBookData(e);
  })
}


var edit_book_details = document.getElementById("form_edit_book");

function getEditDataFormAddBook(formType) {
  var name = document.getElementById("name").value;
  var writterName = document.getElementById("writter_name").value;
  var description = document.getElementById("description").value;
  var avatar = document.getElementById("avatar").files[0];
  var book = document.getElementById("book_file").files[0];

  var dat = {
    name,
    writterName,
    description,
    avatar,
    book,
  };

  return dat;
}

if(edit_book_details){

  const searchParams = new URLSearchParams(window.location.search);

  if(!searchParams.has('edit')){
    window.location.href = "/admin.php";
  }

  id = searchParams.get('edit');


  getBookById(id).then((e)=>{
    document.getElementById("name").value = e.name;
    document.getElementById("writter_name").value = e.writer;
    document.getElementById("description").value = e.description;

  })

  edit_book_details.addEventListener("submit",async(e)=>{
    e.preventDefault();
    let data = getDataFormAddBook();
    console.log(data);

    let form_data = new FormData();

    if(data.name){
      form_data.append("name",data.name);
    }
    if(data.writterName){
      form_data.append("writter",data.writterName);
    }
    if(data.description){
      form_data.append("description",data.description);
    }
    if(data.avatar){
      form_data.append("avatar",data.avatar);
    }
    if(data.book){
      form_data.append("book",data.book);
    }

    form_data.append("updateBookData",true);
    form_data.append("id",id);

    let response = await updateBookData(form_data,id);

    if(response && response.success){
      window.alert(response.message);
      window.location.reload();
    }else{
      console.error(response);
    }
    

  })
  }