import React from 'react';
import { Box } from '@mui/material';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Footer from './components/Footer.js';
import { ThemeProvider } from '@mui/material/styles';
import CssBaseline from '@mui/material/CssBaseline';
import theme from './styles/theme';
import HomePage from './pages/Home/Home.js';
import Login from './pages/Auth/Login.js';
import Register from './pages/Auth/Register.js';
import Topper from './components/Topper/Topper.js';
import Navigation from './components/Navigation/Navigation.js';
import Dashboard from './pages/Dashboard/Dashboard.js';
import ProtectedRoute from './ProtectedRoute';

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Router>
        <main>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/login" element={<Login />} />
            <Route
              path="/dashboard"
              element={
                <ProtectedRoute>
                  <Box sx={{ display: 'flex', height: '100vh' }}>
                    <Topper />
                    <Navigation />
                    <Dashboard />
                  </Box>
                </ProtectedRoute>
              }
            />
            <Route path="/register" element={<Register />} />
          </Routes>
        </main>
        <Footer />
      </Router>
    </ThemeProvider>
  );
}

export default App;
