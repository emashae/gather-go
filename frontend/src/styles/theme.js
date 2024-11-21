import { createTheme } from '@mui/material/styles';

const theme = createTheme({
  palette: {
    primary: {
      main: '#401C9C',
    },
    secondary: {
      main: '#9f89d9',
    },
    background: {
      default: '#0d061c',
    },
    text: {
      primary: '#FFFFFF',
      secondary: '#9f89d9',
    },
  },
  typography: {
    fontFamily: 'Poppins, Arial, sans-serif',
    h1: {
      fontWeight: 700,
    },
    body1: {
      fontWeight: 400,
    },
  },
});

export default theme;
