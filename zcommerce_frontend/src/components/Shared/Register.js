import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import apiClient from '../../services/Services';
import img from './../images/Happy Bunch - Desk.png'
import Swal from 'sweetalert2'

const Register = () => {
  let [errorMessage, setErrorMessage] = useState("");
  const loadLogin = (event) => {
    event.preventDefault();
    const form = event.target;
    const email = form.email.value;
    const password = form.password.value;
    const name = form.name.value;

    apiClient.get("sanctum/csrf-cookie").then((response) => {
      apiClient
        .post("api/auth/register", {
          name:name,
          email: email,
          password: password,
        })
        .then((response) => {
          console.log(response);           
          Swal.fire('Registered Successfully') 
              form.reset()
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
            <h1 className="text-5xl font-bold">Register now!</h1>
            <img src={img} alt="" />
          </div>
          <form
            onSubmit={loadLogin}
            className="card  w-1/2 max-w-sm shadow-2xl bg-base-100"
          >
            <div className="card-body">
            <div className="form-control">
                <label className="label">
                  <span className="label-text">Name</span>
                </label>
                <input
                  name="name"
                  type="text"
                  placeholder="name"
                  className="input input-bordered"
                />
              </div>
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
                    Already Have Account ?{" "}
                    <Link
                      to="/login"
                      className="label-text-alt link link-hover"
                    >
                      Sign In
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

export default Register;