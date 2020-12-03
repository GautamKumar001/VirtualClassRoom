import * as React from 'react';
import Axios from 'axios';


export default class Fileupload extends React.Component {
    constructor(){
      super();
      this.state={
        image: '',
        sucess: false,
        error: false,
        imagePreviewUrl: false
      }
      this.fileUpload = this.fileUpload.bind(this)
this.onChange = this.onChange.bind(this);

    }
    onChange(e) {
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

        async fileUpload(){
        const values = this.state.image
        var self = this;
        await axios.post('http://127.0.0.1:8000/store',  values, { headers: {"Authorization" : `Bearer ${token}`}}).then((res) => {
        if(res.data === '1'){
        self.setState( { sucess : true});
        //window.location.replace("/dashboard");
        }else{
        self.setState( { errorInsert : true});
        }
        }).catch((e)=>{
        console.log(e);
        /*window.sessionStorage.clear();
        window.location.replace('/'); */
        });
        }

    render() {
      return (
        <div className="App">
        <form onSubmit={this.onFormSubmit}  encType="multipart/form-data" >
<h1>Insert Material</h1>
<label className="label_imagem_artigo"> Imagem do artigo: </label>
<input className="input_imagem_artigo" type="file"  onChange={this.onChange} />
<input className="submitbtn"type="submit" value="submit" />
</form>
<p>{this.state.image}</p>
        </div>
      );
    }
  }

