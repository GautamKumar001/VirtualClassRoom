import * as React from 'react';
import ReactDOM from 'react-dom';
import TeacherScreen from './TeacherModule'
import  Fileupload from './FileUpload'

export default class App extends React.Component{
    render()
    {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">App Component</div>
                            <div className="card-body">I'm an App component!</div>
                            <TeacherScreen/>
                            <Fileupload/>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

}

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
