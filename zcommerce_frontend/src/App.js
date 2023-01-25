import logo from './logo.svg';
import './App.css';
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import Main from './layouts/Main';
import Home from './components/Pages/Home';
import Login from './components/Shared/Login';
import Register from './components/Shared/Register';
import Products from './components/Pages/Products';
import { themeChange } from 'theme-change';
import { useEffect } from 'react';
import Cart from './components/Pages/Cart';
import Orders from './components/Pages/Orders';

function App() {
  useEffect(() => {
    themeChange(false);
  }, []);
  const router = createBrowserRouter([
    {
      path:'/',
      element:<Main></Main>,
      children:[
        {
          path:'/',
          element:<Home></Home>
        },
        {
          path:'/login',
          element:<Login></Login>
        },
        {
          path:'/register',
          element:<Register></Register>
        },
        {
          path:'/products',
          element:<Products></Products>
        },
        {
          path:'/cart',
          element:<Cart></Cart>
        },
        {
          path:'/orders',
          element:<Orders></Orders>
        }
      ]
    }
  ])
  return (
    <div className="container m-auto">
      <RouterProvider router={router}></RouterProvider>
    </div>
  );
}

export default App;
