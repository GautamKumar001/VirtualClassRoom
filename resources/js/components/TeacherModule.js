import * as React from 'react';
import Axios from 'axios';


export default class TeacherScreen extends React.Component{
    constructor(props) {
        super(props);
        this.state={
            Name:null,
            email:null,
            gender:null,
            age:null,
            institute:null,
            Identity:null,
            image:null,
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleInputChange2 = this.handleInputChange2.bind(this);
        this.handleInputChange= this.handleInputChange.bind(this);

    }
    handleInputChange2(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
        return;
        this.createImage(files[0]);
        }
        createImage(file) {
        let reader = new FileReader();
        reader.onload = (e) => {
        this.setState({
       Identity: e.target.result
        })
        };
        reader.readAsDataURL(file);
        }
        handleInputChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            this.createImage(files[0]);
            }
            createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
            this.setState({
            image: e.target.result
            })
            };
            reader.readAsDataURL(file);
            }

    handleChange(text,field){
        const state=this.state;
        state[field]=text;
        this.setState(state);
    }
    componentDidMount()
    {
        this.getToken();
    }
    getToken(){
        Axios.get('http://127.0.0.1:8000/teacherindex').then((res)=>console.log(res));
    }
    postTeacher(event){
    event.preventDefault();
      const fileInput = document.querySelector('#fileupload') ;
      const formData = new FormData();
      formData.append('Identity', fileInput.files[0]);
      const fileInput2 = document.querySelector('#fileupload2') ;
      console.log(fileInput2);
      const formData2 = new FormData();
      formData2.append('image', fileInput2.files[0]);
      console.log(formData2);
        Axios.post('http://127.0.0.1:8000/teacherstore',{
            Name:this.state.Name,
            email:this.state.email,
            gender:this.state.gender,
            age:this.state.age,
            institute:this.state.institute,
            Identity:formData,
            image:formData2,
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': 'lchSiQtmWPdnWxPwmGEbVE8N42Iark9kjDwr0F28',
               },

}).then((res)=>{
res.send('teacher created');
})
    }
    render(){
        return(<>
            <div className='container'>
<form onSubmit={()=>this.postTeacher()} encType="multipart/form-data">
            <input  type="text" name="Name" id="teacherinput" placeholder="Enter your Name"  onChange={(e)=>{this.handleChange(e.target.value,'Name')}}></input>
            <input type="text" name="email" id="teacherinput" placeholder="Enter your Email"  onChange={(e)=>{this.handleChange(e.target.value,'email')}}></input>

            <input type="text" name="gender" id="teacherinput" placeholder="Enter your Gender"  onChange={(e)=>{this.handleChange(e.target.value,'gender')}}></input>

            <input type="text" name="age" id="teacherinput" placeholder="Enter your Age"  onChange={(e)=>{this.handleChange(e.target.value,'age')}}></input>

            <input type="text" name="institute" id="teacherinput" placeholder="Enter your Institute Name" onChange={(e)=>{this.handleChange(e.target.value,'institute')}}></input>

            <input type="file" name="Identity" id="fileupload" placeholder="Upload your Institute Identity Card Image"  ></input>

            <input type="file" name="image" id="fileupload2" placeholder="Upload your Image" ></input>

            <input className="submitbtn"type="submit" value="submit" ></input>

        </form>

            </div>
            <div>
                  <p>
            {this.state.Name}
        </p>
        <p>
            {this.state.
            image}
        </p>
        <p>
            {this.state.
            Identity}
        </p>
        <button onClick={()=>this.getToken()}>Token</button>
            </div>
</>
        );
    }

}
