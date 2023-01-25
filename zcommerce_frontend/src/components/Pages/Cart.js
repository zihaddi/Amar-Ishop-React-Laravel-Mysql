import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";
import CartList from "./CartList";

const Cart = () => {
  const [cart, setCart] = useState(JSON.parse(localStorage.getItem("CART")));
  const [qty, setQty] = useState([]);
  const navigate = useNavigate()
  const cartProducts = JSON.parse(localStorage.getItem("CART"));
  let user = JSON.parse(localStorage.getItem("USER"))
  let userId = user.id
  const onRemove = (id, event) => {
    const selectedCart = cartProducts.filter((c) => c.id !== id);
    localStorage.setItem("CART", JSON.stringify(selectedCart));
    setCart(selectedCart);
  };

  const loadCheckout = (event) =>
  {
    event.preventDefault();
    const form = event.target;
    const total_price = form.total_price.value;
    const order_type = form.order_type.value;
    const transaction_id = form.transaction_id.value;
    const billing_address = form.billing_address.value;
    const shipping_address = form.shipping_address.value;
    const status = "pending"
    const uid = userId
    const preparedData = 
    {
      uid,
      total_price, 
      status,
      order_type,
      transaction_id,
      billing_address,
      shipping_address,
      products:cart
    }
    console.log(preparedData)
   
    fetch("http://127.0.0.1:8000/api/createOrders", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: JSON.stringify(preparedData),
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
        Swal.fire('Order Generated Successfully')
        navigate('/orders')
      });

  }

  const loadIncrease = (id) => {
    let localData = JSON.parse(localStorage.getItem("CART"));
    const filter = localData.filter((d) => d.id == id);
    filter[0].qty = filter[0].qty + 1;
    // setQty(filter[0].qty);
    console.log(filter[0].qty);
    let existDataWithoutThis = localData.filter((d) => d.id !== id);
    existDataWithoutThis.push(filter[0]);
    console.log(existDataWithoutThis);
    localStorage.setItem("CART", JSON.stringify(existDataWithoutThis));
    setCart(JSON.parse(localStorage.getItem("CART")));
  };

  const loadDecrease = (id) => {
    let localData = JSON.parse(localStorage.getItem("CART"));
    const filter = localData.filter((d) => d.id == id);
    filter[0].qty = filter[0].qty - 1;
    //  setQty(filter[0].qty);
    let existDataWithoutThis = localData.filter((d) => d.id !== id);
    existDataWithoutThis.push(filter[0]);
    console.log(existDataWithoutThis);
    localStorage.setItem("CART", JSON.stringify(existDataWithoutThis));
    setCart(JSON.parse(localStorage.getItem("CART")));
  };

  return (
    <div className="flex">
      <div className="flex-1 w-68">
        {cart.map((product) => (
          <CartList
            key={product.id}
            cartProducts={product}
            onRemove={onRemove}
            loadIncrease={loadIncrease}
            loadDecrease={loadDecrease}
            qty={qty}
          ></CartList>
        ))}
      </div>
      <div className="my-9">
        <div className="card w-100 bg-primary text-primary-content">
          <div className="card-body">
            <h2 className="card-title">CART DETAILS</h2><br />

            <form onSubmit={loadCheckout}>
            <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Selected Items </span>
                  <input
                    
                    type="text"
                    className="input input-bordered input-md"
                    value={cart.reduce((accumulator, object) => {
                      return accumulator + object.qty;
                    }, 0)}
                  />
                </label>
              </div>
              <br />
              <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Total </span>
                  <input
                    type="text"
                    name='total_price'
                    className="input input-bordered input-md"
                    value={cart.reduce((accumulator, object) => {
                      return accumulator + object.price * object.qty;
                    }, 0)}
                  />
                </label>
              </div>
              <br />
{/*               
              <p>
                Total :
                <input
                  type="text"
                  className="btn btn-xs w-14"
                  value={cart.reduce((accumulator, object) => {
                    return accumulator + object.price * object.qty;
                  }, 0)}
                />
              </p> */}
              <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Payment Type</span>
                  <input
                    name='order_type'
                    type="text"
                    className="input input-bordered input-md"
                  />
                </label>
              </div>
              <br />
              <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Transaction Id</span>
                  <input
                  name="transaction_id"
                    type="text"
                    className="input input-bordered input-md"
                  />
                </label>
              </div>
              <br />
              <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Shipping Address</span>
                  <input
                   name='shipping_address'
                    type="text"
                    className="input input-bordered input-md"
                  />
                </label>
              </div>
              <br />
              <div className="form-control">
                <label className="input-group input-group-md">
                  <span>Billing Address</span>
                  <input
                    name="billing_address"
                    type="text"
                    className="input input-bordered input-md"
                  />
                </label>
              </div>
              <br />
              <input type='submit' className="btn" value='checkout'/>
            
            </form>
            
          </div>
        </div>
      </div>
    </div>
  );
};

export default Cart;
