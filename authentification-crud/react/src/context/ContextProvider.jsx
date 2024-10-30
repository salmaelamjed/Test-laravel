import { createContext, useContext, useState } from "react";
import PropTypes from 'prop-types';  // Importation de PropTypes

const StateContext = createContext({
    user: null,
    token: null
});

 const ContextProvider = ({ children }) => {
    const [user, setUser] = useState({
        name:'salma'
    });
    const [token, _setToken] = useState(null);

    const setToken = (token) => {
        _setToken(token);
        if (token) {
            localStorage.setItem('ACCESS_TOKEN', token);
        } else {
            localStorage.removeItem('ACCESS_TOKEN');
        }
    };

    return (
        <StateContext.Provider value={{
            user,
            token,
            setUser,
            setToken,
        }}>
            {children}
        </StateContext.Provider>
    );
};

// Validation des props avec PropTypes
ContextProvider.propTypes = {
    children: PropTypes.node.isRequired,
};

// **Ajoutez ce hook personnalisé pour accéder facilement au contexte**
const useStateContext = () => useContext(StateContext);
export {useStateContext,ContextProvider}
