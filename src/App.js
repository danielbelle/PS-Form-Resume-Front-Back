import regimg from './img/note-send.jpg';
import Formcv from './components/Formcv';
import './App.css';

function App() {
  return (
    <div className="container mt-3">
      <div className="row">
        <div className="col-md-6 my-auto">
          <h1 className='my-1 fw-bold ms-4'>Envie seu Currículo</h1>
          <img className="img-fluid w-100" src={regimg} alt="" />
        </div>
        <div className="col-md-6">
          <Formcv />
        </div>
      </div>
    </div>
  );
}

export default App;
