export const styles = {
  container: {
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    height: '100vh',
    backgroundImage: 'linear-gradient(to bottom right, #9f89d9, #0d061c)',
  },
  card: {
    padding: 4,
    width: '100%',
    maxWidth: 400,
    backdropFilter: 'blur(10px)',
    backgroundColor: 'rgba(16, 6, 28, 0.8)',
    borderRadius: '12px',
    textAlign: 'center',
  },
  title: {
    color: '#9f89d9',
    marginBottom: '16px',
  },
  input: {
      marginBottom: '16px',
      '& .MuiOutlinedInput-root': {
        backgroundColor: 'rgba(255, 255, 255, 0.1)', 
        borderRadius: '8px', 
        '& fieldset': {
          borderColor: '#401C9C',
        },
        '&:hover fieldset': {
          borderColor: '#9f89d9',
        },
        '&.Mui-focused fieldset': {
          borderColor: '#9f89d9',
        },
      },
      '& .MuiInputBase-input': {
        color: '#ffffff', 
      },
      '& .MuiInputLabel-root': {
        color: '#9f89d9', 
      },
      '& .MuiInputLabel-root.Mui-focused': {
        color: '#9f89d9',
      },
    },
  button: {
    marginTop: 2,
    backgroundColor: '#401C9C',
    '&:hover': {
      backgroundColor: '#310f77',
    },
  },
  errorMessage: {
    marginTop: '16px',
    color: 'red',
  },
};
