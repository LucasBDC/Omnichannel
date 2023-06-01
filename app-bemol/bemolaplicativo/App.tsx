import React, { useState, useCallback } from 'react';
import { View, TextInput, Button } from 'react-native';

interface IAdress {
  cep?: string,
  logradouro?: string,
  bairro?: string,
  localidade?: string,
  uf?: string,
}

const RegistrationForm = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [cep, setCep] = useState('');
  const [logradouro, setLogradouro] = useState('');
  const [bairro, setBairro] = useState('');
  const [estado, setEstado] = useState('');
  const [localidade, setLocalidade] = useState('');

  const handleCepBlur = async () => {
    if (cep.length === 8) {
      try {
        const response = await fetch(
          `http://192.168.0.5/bemol-server-php/Auth/viacep.php/viacep-proxy.php?cep=${cep}&api_key=your-api-key`
        );
        if (response.status === 401) {
          throw new Error('Unauthorized');
        }
        const data = await response.json();
        setLogradouro(data.logradouro);
        setBairro(data.bairro);
        setEstado(data.uf);
        setLocalidade(data.localidade);
      } catch (error) {
        console.error(error);
      }
    }
  };
  
  

  const handleRegistration = () => {
    const data = {
      name: name,
      email: email,
      password: password,
      cep: cep,
    };

    fetch('http://192.168.0.5/bemol-server-php/Auth/authentication.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((json) => {
        // Handle the response from the PHP API
        console.log(json.message);
      })
      .catch((error) => {
        console.error(error);
      });
  };

  return (
    <View>
      <TextInput
        placeholder="Name"
        value={name}
        onChangeText={setName}
      />
      <TextInput
        placeholder="Email"
        value={email}
        onChangeText={setEmail}
      />
      <TextInput
        placeholder="Password"
        value={password}
        onChangeText={setPassword}
        secureTextEntry
      />
       <TextInput
        placeholder="CEP"
        value={cep}
        onChangeText={setCep}
        onBlur={handleCepBlur}
      />

      <TextInput
        placeholder="Logradouro"
        value={logradouro}
        onChangeText={setLogradouro}
        editable={false} 
      />

      <TextInput
        placeholder="Bairro"
        value={bairro}
        onChangeText={setBairro}
        editable={false} 
      />

      <TextInput
        placeholder="Estado"
        value={estado}
        onChangeText={setEstado}
        editable={false} 
      />

      <TextInput
        placeholder="Localidade"
        value={localidade}
        onChangeText={setLocalidade}
        editable={false} 
      />
      <Button title="Register" onPress={handleRegistration} />
    </View>
  );
};

export default RegistrationForm;
