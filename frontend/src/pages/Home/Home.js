import React from 'react';
import { useNavigate } from 'react-router-dom';
import './Home.css';

function HomePage() {
  const navigate = useNavigate();

  const handleGetStartedClick = () => {
    navigate('/login'); 
  };

  return (
    <div className="hero-section">
      {/* Background Video */}
      <video className="background-video" autoPlay loop muted>
        <source src="/video/bg.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>

      {/* Overlay */}
      <div className="overlay"></div>

      {/* Content */}
      <div className="hero-content">
        <h1 className="hero-title">GatherGo</h1>
        <p className="hero-subtitle">Streamline your events, tickets, and attendee engagement.</p>
        <button className="hero-button" onClick={handleGetStartedClick}>Get Started</button>
      </div>
    </div>
  );
}

export default HomePage;
