import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import reportWebVitals from './reportWebVitals';
import App from "./App";
import {AlertProvider} from "./common/context/AlertContext";

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);
root.render(
  <React.StrictMode>
      <AlertProvider>
        <App />
      </AlertProvider>
  </React.StrictMode>
);

reportWebVitals();
