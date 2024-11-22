import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000',
  withCredentials: true,
  withXSRFToken: true,
  headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
  },
});


//request the CSRF token
const getCsrfToken = async () => {
  try {
    await axiosInstance.get('/sanctum/csrf-cookie'); 
  } catch (error) {
    console.error("CSRF token request failed:", error);
  }
};


export const login = createAsyncThunk(
  'auth/login',
  async (userCredentials, { rejectWithValue }) => {
    try {
      // Get CSRF token before login
      await getCsrfToken();

      // Send login request
      const response = await axiosInstance.post('/api/login', userCredentials);
      return response.data; 
    } catch (error) {
      return rejectWithValue(error.response.data); 
    }
  }
);

export const register = createAsyncThunk(
  'auth/register',
  async (userDetails, { rejectWithValue }) => {
    try {
      // Request CSRF token before registration
      await getCsrfToken();

      // Send registration request
      const response = await axiosInstance.post('/api/register', userDetails);
      return response.data; 
    } catch (error) {
      return rejectWithValue(error.response.data);
    }
  }
);

const authSlice = createSlice({
  name: 'auth',
  initialState: {
    user: null,
    isLoading: false,
    error: null,
  },
  reducers: {},
  extraReducers: (builder) => {
    builder
      //Login
      .addCase(login.pending, (state) => {
        state.isLoading = true;
      })
      .addCase(login.fulfilled, (state, action) => {
        state.isLoading = false;
        state.user = action.payload; 
      })
      .addCase(login.rejected, (state, action) => {
        state.isLoading = false;
        state.error = action.payload;
      })
      // Register 
      .addCase(register.pending, (state) => {
        state.isLoading = true;
      })
      .addCase(register.fulfilled, (state, action) => {
        state.isLoading = false;
        state.user = action.payload;
      })
      .addCase(register.rejected, (state, action) => {
        state.isLoading = false;
        state.error = action.payload;
      });
  },
});

export default authSlice.reducer;
