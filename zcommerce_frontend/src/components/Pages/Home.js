import React, { useEffect, useState } from "react";
import image4 from "../images/car4.jpg";
import image5 from "../images/car5.jpg";
import image6 from "../images/car6.jpg";
import image7 from "../images/car7.jpg";
import Swal from "sweetalert2";
import axios from "axios";
const Home = () => {
  let [products, setProducts] = useState([]);
  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/products", {
        headers: {
          Authorization: `Bearer ${JSON.parse(localStorage.getItem("TOKEN"))}`,
        },
      })
      .then((response) => {
        // console.log(response.data);
        setProducts(response.data);
      })
      .catch((error) => console.error(error));
  }, []);

  let cc = JSON.parse(localStorage.getItem('CART'))
  let [cart, setCart] = useState([]);

  const loadCart = (id) => {
    
    let filteredProduct = products.filter((product) => product.id == id);
    filteredProduct[0].qty = 1;
    //  console.log(filteredProduct[0]);
    if (localStorage.getItem("CART")) {
      let existCart = JSON.parse(localStorage.getItem("CART"));
      // console.log(existCart);
      let test = existCart.filter((c) => c.id == id);
      console.log(test)
      if (test.length == 0) {
        Swal.fire("Added To Cart");
        if (typeof existCart == "object" && Array.isArray(existCart) == false) {
          setCart([existCart, filteredProduct[0]]);
        } else {
          //console.log(Array.isArray(existCart));
          existCart.push(filteredProduct[0]);
          setCart(existCart);
        }
      } else {
        Swal.fire("Cant not click two times");
      }
    } else {
      setCart(filteredProduct[0]);
    }
  };

  useEffect(() => {
    localStorage.setItem("CART", JSON.stringify(cart));
  }, [cart]);

  return (
    <div>
      <div className="carousel w-full">
        <div id="slide1" className="carousel-item relative w-full">
          <img src={image4} alt="" className="w-full" />
          <div className="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide4" className="btn btn-circle">
              ❮
            </a>
            <a href="#slide2" className="btn btn-circle">
              ❯
            </a>
          </div>
        </div>
        <div id="slide2" className="carousel-item relative w-full">
          <img src={image5} alt="" className="w-full" />
          <div className="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide1" className="btn btn-circle">
              ❮
            </a>
            <a href="#slide3" className="btn btn-circle">
              ❯
            </a>
          </div>
        </div>
        <div id="slide3" className="carousel-item relative w-full">
          <img src={image6} alt="" className="w-full" />
          <div className="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide2" className="btn btn-circle">
              ❮
            </a>
            <a href="#slide4" className="btn btn-circle">
              ❯
            </a>
          </div>
        </div>
        <div id="slide4" className="carousel-item relative w-full">
          <img src={image7} alt="" className="w-full" />
          <div className="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide3" className="btn btn-circle">
              ❮
            </a>
            <a href="#slide1" className="btn btn-circle">
              ❯
            </a>
          </div>
        </div>
      </div>
      <div className="grid grid-cols-3 gap-5">
        {products.map((product) => (
          <>
            <div className="card w-100 bg-base-100 shadow-xl">
              <figure className="px-10 pt-10">
                <img src={product.image} alt="Shoes" className="rounded-xl" />
              </figure>
              <div className="card-body items-center text-center">
                <h2 className="card-title">{product.name}</h2>
                <p>Price : {product.price}$</p>
                <div className="card-actions">
                  <button
                    onClick={() => loadCart(product.id)}
                    className="btn btn-primary"
                  >
                    Add To Cart
                  </button>
                </div>
              </div>
            </div>
          </>
        ))}
      </div>
    </div>
  );
};

export default Home;
