import React, {  useState } from "react";
import { Link,useNavigate } from "react-router-dom";
import apiClient from "../../services/Services";
import img from './../images/Happy Bunch - Desk.png'
import Swal from 'sweetalert2'

const Login = () => {
  const [token, setToken] = useState();
  const [user , setUser] = useState()
  let [errorMessage, setErrorMessage] = useState("");
  const navigate = useNavigate();
  const loadLogin = (event) => {
    event.preventDefault();
    const form = event.target;
    const email = form.email.value;
    const password = form.password.value;

    apiClient.get("sanctum/csrf-cookie").then((response) => {
      apiClient
        .post("api/auth/login", {
          email: email,
          password: password,
        })
        .then((response) => {
         // console.log(response);
       
           // console.log(response.data.token)
              if(localStorage.getItem('TOKEN'))
              {
              localStorage.removeItem("TOKEN");
             }
            
              setToken( JSON.stringify(response.data.token));
              setUser(JSON.stringify(response.data.user))
             JSON.parse(token);
              //const taken = JSON.stringify(token)
              localStorage.setItem("USER", user);
              localStorage.setItem("TOKEN", token);
              Swal.fire('Logged In Successfully')
              navigate("/");
             
         
        })
        .catch(function (error) {
          console.log(error.response.data.message);
          setErrorMessage(error.response.data.message);
        });
    });
  };

  const tokens = JSON.parse(localStorage.getItem("TOKEN"));

  return (
    <div className="container">
      <div className="hero min-h-screen my-0 bg-base-200">
        <div className="flex px-4 py-0 my-0 justify-center">
          <div className="text-center lg:text-left w-1/2">
            <h1 className="text-5xl font-bold">Login now!</h1>
            <img src={img} alt="" />
          </div>
          <form
            onSubmit={loadLogin}
            className="card  w-1/2 max-w-sm shadow-2xl bg-base-100"
          >
            <div className="card-body">
              <div className="form-control">
                <label className="label">
                  <span className="label-text">Email</span>
                </label>
                <input
                  name="email"
                  type="text"
                  placeholder="email"
                  className="input input-bordered"
                />
              </div>
              <div className="form-control">
                <label className="label">
                  <span className="label-text">Password</span>
                </label>
                <input
                  name="password"
                  type="password"
                  placeholder="password"
                  className="input input-bordered"
                />
                <label className="label">
                  <p>
                    Dont Have Account ?{" "}
                    <Link
                      to="/register"
                      className="label-text-alt link link-hover"
                    >
                      Sign Up
                    </Link>
                  </p>
                </label>
              </div>
              <div className="form-control mt-6">
                <input
                  type="submit"
                  value="submit"
                  className="btn btn-primary"
                />
              </div>
            </div>
          </form>
        </div>
        {errorMessage ? errorMessage : ""}
      </div>
    </div>
  );
};

export default Login;
