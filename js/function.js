const URI= `/action.php`;
async function login(username,password){
    try {
        let form_data = new FormData();
        form_data.append("login",true);
        form_data.append("username",username);
        form_data.append("password",password);

        let response = await fetch(`${URI}`,{
            method:"POST",
            body:form_data
        });
        response =await response.json();
        return response
    } catch (error) {
        console.log(error);
        return {success:false,message:`Error:${error}`};
    }
}

async function signup(name,email,username,password,phno){
    try {
        let form_data = new FormData();
        form_data.append("signup",true);
        form_data.append("name",name);
        form_data.append("email",email);
        form_data.append("username",username);
        form_data.append("password",password);
        form_data.append("phno",phno);

        let response = await fetch(`${URI}`,{
            method:"POST",
            body:form_data
        });
        response =await response.json();
        return response
    } catch (error) {
        console.log(error);
        return {success:false,message:`Error:${error}`};
    }
}

async function checkUsernameExists(username){
    try {
        let response = await fetch(`${URI}?checkUsernameExists=${username}`,{
            method:"GET",
        });
        response =await response.json();
        console.log(response)
        return response
    } catch (error) {
        console.log(error);
        return {success:false,message:`Error:${error}`};
    }
}

async function addBooks(data){
    try {
        let form_data = new FormData();
        form_data.append("addBooks",true);
        form_data.append("name",data.name);
        form_data.append("writter",data.writterName);
        form_data.append("description",data.description);
        form_data.append("avatar",data.avatar);
        form_data.append("book",data.book);

        let response = await fetch(`${URI}`,{
            method:"POST",
            body:form_data
        })
        response = await response.json();
        return response;
    } catch (error) {
        console.error(error);
    }
}


async function getAllBooksData(){
    try {
        let response = await fetch(`${URI}?getAllBooksData=true`);
        response = await response.json();
                return response;
    } catch (error) {
        console.error(error);
    }
}

async function searchBooks(search){
    try {
        let response = await fetch(`${URI}?bookSearchByName=${search}`);
        response = await response.json();
        return response;
    } catch (error) {
        console.error(error);
    }
}

async function deleteBooks(id){
    try {
        let response = await fetch(`${URI}?deleteBook=${id}`);
        response = await response.json();
        return response;
    } catch (error) {
        console.error(error);
    }
}

async function getBookById(id){
    try {
        let response = await fetch(`${URI}?getBookById=${id}`);
        response = await response.json();
        return response;    
    } catch (error) {
        console.error(error);s
    }
}

async function updateBookData(data,id){
    try {
        let response = await fetch(`${URI}`,{
            method:"POST",
            body:data
        })
        response = await response.json();
        return response;
    } catch (error) {
        console.error(error);
    }
}