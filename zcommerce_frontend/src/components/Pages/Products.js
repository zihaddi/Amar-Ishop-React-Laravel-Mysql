import React, { useEffect, useState } from 'react';
import axios from 'axios'
const Products = () => {

  let [products, setProducts] = useState([]);
  useEffect(() => {
    axios
      .get("http://127.0.0.1:8000/api/products" ,
      {
        headers: {
          'Authorization': `Bearer ${JSON.parse(localStorage.getItem('TOKEN'))}`
        }
      })
      .then((response) => {
       // console.log(response.data)
        setProducts(response.data);
      })
      .catch((error) => console.error(error));
  }, []);


  return (
    <div className="overflow-x-auto w-full">
  <table className="table w-full">
    
    <thead>
      <tr>
        <th>
          <label>
            <input type="checkbox" className="checkbox" />
          </label>
        </th>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    {
        products.map(product => 
          <>
          <tr>
         <td>
          <label>
            <input type="checkbox" className="checkbox" />
          </label>
        </td>
        <td>{product.id}</td>
        <td ><img className='w-9' src={product.image} alt="" /></td>
        <td className='w-7'>{product.name}</td>
        <td>{product.quantity}</td>
        <td>{product.price} BDT</td>
      </tr>
          </>)
      }
    </tbody>
    
    
  </table>
</div>
  );
};

export default Products;