import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";

const Header = () => {
  const navigate = useNavigate();

  const loadLogout = () => {
    axios
      .post(
        "http://127.0.0.1:8000/api/auth/logout",
        {},
        {
          headers: {
            Authorization: `Bearer ${JSON.parse(
              localStorage.getItem("TOKEN")
            )}`,
          },
        }
      )
      .then((res) => {
       // console.log(res.data);
        localStorage.removeItem("TOKEN");
        localStorage.removeItem('USER')
        localStorage.removeItem('CART')
        navigate("/login");
      })
      .catch((error) => {
        console.error(error);
      });
  };

 

  const user = JSON.parse(localStorage.getItem("USER"));
  return (
    <div className="rounded-md mt-2">
      {/* modal portion */}
      <input type="checkbox" id="my-modal-5" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box w-11/12 max-w-5xl">
          <h3 className="font-bold text-lg">Welcome , {user? user.name : ''}</h3>
          <p className="py-4">Your Mail : {user ? user.email : ''}</p>
          <div className="modal-action">
            <label htmlFor="my-modal-5" className="btn">
              Ok!
            </label>
          </div>
        </div>
      </div>
      {/* modal portion */}
      <div className="navbar bg-primary text-primary-content m-auto rounded-md flex justify-between">
        <div className="navbar-start">
          <div className="dropdown">
            <label tabIndex={0} className="btn btn-ghost lg:hidden">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth="2"
                  d="M4 6h16M4 12h8m-8 6h16"
                />
              </svg>
            </label>
            <ul
              tabIndex={0}
              className="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
            >
              <li>
                <Link to="/login">Login</Link>
              </li>
              <li tabIndex={0}>
                <a href="/" className="justify-between">
                  Parent
                  <svg
                    className="fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                  >
                    <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                  </svg>
                </a>
                <ul className="p-2">
                  <li>
                    <a href="/">Submenu 1</a>
                  </li>
                  <li>
                    <a href="/">Submenu 2</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="/">Item 3</a>
              </li>
            </ul>
          </div>
          <Link to="/" className="btn btn-ghost normal-case text-xl">
           AMAR ISHOP
          </Link>
        </div>
        <div className="navbar-right hidden lg:flex">
          <ul className="menu menu-horizontal px-1">
            {localStorage.getItem("TOKEN") ? (
              <>
                <div className="d-flex">
                <Link className="mx-3" to="/products">Products</Link>
                <Link to="/orders">Orders</Link>
                </div>
              </>
            ) : (
              <>
                  <Link to="/login">Login</Link>
              </>
            )}
            
          </ul>
          <div></div>
          {localStorage.getItem('TOKEN') ?
          <>
           <div className="flex-none ">
            <div className="dropdown dropdown-end">
              <label tabIndex={0} className="btn btn-ghost btn-circle">
                <div className="indicator">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth="2"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                    />
                  </svg>
                  <span className="badge badge-sm indicator-item">{localStorage.getItem('CART')?(JSON.parse(localStorage.getItem('CART'))).length: <></>}</span>
                </div>
              </label>
              <div
                tabIndex={0}
                className="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow"
              >
                <div className="card-body">
                  <span className="font-bold text-lg">{localStorage.getItem('CART')?(JSON.parse(localStorage.getItem('CART'))).length: <></>}</span>
                  <span className="text-info">Subtotal: $999</span>
                  <div className="card-actions">
                    <Link to='/cart' className="btn btn-primary btn-block">
                      View cart
                    </Link>
                  </div>
                </div>
              </div>
            </div>
            {localStorage.getItem("TOKEN") ? (
              <>
                <div className="dropdown dropdown-end">
                  <label
                    tabIndex={0}
                    className="btn btn-ghost btn-circle avatar"
                  >
                    <div className="w-10 rounded-full">
                      <img src="https://placeimg.com/80/80/people" />
                    </div>
                  </label>
                  <ul
                    tabIndex={0}
                    className="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
                  >
                    <li>
                      <label htmlFor="my-modal-5" className="justify-between">
                        Profile
                      </label>

                      {/* Put this part before </body> tag */}
                    </li>
                    <li>
                      <a href="/">Settings</a>
                    </li>
                    <li>
                      <button onClick={loadLogout}>Logout</button>
                    </li>
                  </ul>
                </div>
              </>
            ) : (
              <></>
            )}
            
         
          </div>
          </>:
          <>
          </>}
          <select className="select  mx-2" data-choose-theme>
              <option disabled value="">
                Pick a theme
              </option>
              <option value="">Night</option>
              <option value="cupcake">Light</option>
              <option value="cyberpunk">Cyberpunk</option>
            </select>
        </div>
      </div>
    </div>
  );
};

export default Header;
