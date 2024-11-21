import React from 'react';
import { NavLink } from 'react-router-dom';
import './Header.css';

function Header() {
  return (
    <header className="header">
      <nav className="nav">
        <NavLink to="/" className="nav-link" end>
          Home
        </NavLink>
      </nav>
    </header>
  );
}

export default Header;
