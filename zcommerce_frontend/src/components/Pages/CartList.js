import React, { useState } from "react";
import { Form } from "react-router-dom";
import "./CartList.css";
const CartList = ({ cartProducts, onRemove ,loadIncrease , loadDecrease ,qty}) => {
  let { id, name, image, price, quantity } = cartProducts;

  let localData = JSON.parse(localStorage.getItem("CART"));
  const filter = localData.filter((d) => d.id == id);

  //let [qty, setQty] = useState(filter[0].qty);



  
  return (
    <div>
      <div className="review-design">
        <div className="img-design">
          <img src={image} alt="" />
          <div className="sub-details-design">
            {name}
            <p>
              Price : <span className="price-color">${price}</span>
            </p>
            <p>
              Quantity : <span className="price-color">${quantity}</span>
            </p>
          </div>
          <div className="ml-20 my-auto">
            <button onClick={()=>loadDecrease(id)} className="btn btn-primary">
              -
            </button>
            <input
              type="text"
              className="input input-bordered input-error w-20 max-w-xs"
              name="quantiy"
              value={qty}
            />
            <button onClick={()=>loadIncrease(id)} className="btn btn-primary">
              +
            </button>
          </div>
        </div>
        <div className="details-design">
          <div>
            <button onClick={() => onRemove(id)} className="rm-btn-design">
              X
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CartList;
