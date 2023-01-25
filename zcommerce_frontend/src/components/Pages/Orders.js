import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";

const Orders = () => {
  const user = localStorage.getItem("USER");
  const navigate = useNavigate()
  let userObj = JSON.parse(user);
  let userID = userObj.id;
  const [orders, setOrders] = useState([]);
  const [orderdetailss, setOrderdetailss] = useState([]);
  const loadDetails = (id) => {
    fetch("http://127.0.0.1:8000/api/orderdetails", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: JSON.stringify({ id: id }),
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data.orderdetails);
        setOrderdetailss(data.orderdetails);
        
      });
  };
  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/orders", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: JSON.stringify({ id: userID }),
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data.orders);
        setOrders(data.orders);
      });
  }, [userID]);
  return (
    <div>
      <input type="checkbox" id="my-modal" className="modal-toggle" />
      <div className="modal">
        <div className="modal-box w-11/12 max-w-5xl">
          <h3 className="font-bold text-lg">Order Details :</h3>

          <div className="overflow-x-auto">
            <table className="table w-full">
              <thead>
                <tr>
                  <th></th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                {orderdetailss.map((orderdet) => (
                  <>
                    <tr>
                      <th></th>
                      <th>
                        <img
                          className="w-9"
                          src={orderdet.image.image}
                          alt={orderdet.name.name}
                        />
                      </th>
                      <th>{orderdet.name.name}</th>
                      <th> {orderdet.quantity}</th>
                      <th>{orderdet.total} BDT</th>
                    </tr>
                  </>
                ))}
                <tr>
                  <th></th>
                  <td></td>
                  <td></td>
                  <th className="text-neutral">Total </th>
                  <th>
                    {" "}
                    {orderdetailss.reduce((accumulator, object) => {
                      return accumulator + object.total;
                    }, 0)} BDT
                  </th>
                </tr>
              </tbody>
            </table>
          </div>
          <div className="modal-action">
            <label htmlFor="my-modal" className="btn">
              Okay!
            </label>
          </div>
        </div>
      </div>

      <table className="table w-full">
        <thead>
          <tr>
            <th>
              <label>
                <input type="checkbox" className="checkbox" />
              </label>
            </th>

            <th>TOTAL PRICE</th>
            <th>PAYMENT TYPE</th>
            <th>TRANSACTION ID</th>
            <th>BILLING ADDRESS</th>
            <th>SHIPPING ADDRESS</th>
            <th>STATUS</th>
            <th>ORDER DETAILS</th>
          </tr>
        </thead>
        <tbody>
          {orders.map((order) => (
            <>
              <tr>
                <td>
                  <label>
                    <input type="checkbox" className="checkbox" />
                  </label>
                </td>

                <td>{order.total_price} BDT</td>

                <td>{order.order_type}</td>
                <td>{order.transaction_id}</td>
                <td>{order.billing_address}</td>
                <td>{order.shipping_address}</td>
                {/* <td>
                {order.status === 'pending'?
                <><p className="badge badge-warning"> Pending </p></>:
                <><p className="badge badge-primary"> Approved </p></> }
                </td> */}
                <td>
                {order.status === 'pending'?
                 <><p className="badge badge-secondary"> Pending </p></>:
                 order.status === 'approved'?
                 <><p className="badge badge-primary"> Approved </p></> :
                 order.status === 'completed'?
                 <><p className="badge badge-success"> Completed </p></> :
                 <><p className="badge badge-warning"> Shipping </p></>
                 }
                </td>
                {/* {!! ($order->status == 'pending')? 
          '<td class="  w-50 text-danger  border-spacing-1">pending</td>':
          (($order->status == 'approved')?
          '<td class="  w-50 text-primary  border-spacing-1">approved</td>':
          (($order->status == 'completed')?
          '<td class="  w-50 text-success  border-spacing-1">completed</td>':
          '<td class="  w-50 text-warning  border-spacing-1">shipping</td>'))
          !!} */}
                <td>
                  <button onClick={() => loadDetails(order.id)}>
                    <label
                      htmlFor="my-modal"
                      className="btn btn-active btn-primary btn-sm"
                    >
                      Details
                    </label>
                  </button>
                </td>
              </tr>
            </>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Orders;
