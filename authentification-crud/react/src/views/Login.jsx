import { Link } from "react-router-dom";

const Login = () => {

    const onSubmit = (ev) => {
        ev.preventDefault();
      };
  return (
    <div className="login-signup-form animated fadeInDown">
         <div className="form">

            <form action="" onSubmit={onSubmit}>
                <h1 className="title">Login into your Account</h1>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <button className="btn btn-block">Login</button>
                <p className="message">Not Register? <Link to='/signup' >Create an Account</Link></p>
            </form>
         </div>
        </div>
  )
}

export default Login
