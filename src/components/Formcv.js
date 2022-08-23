import React from 'react';
import { Formik, Form } from 'formik';
import { TextField } from './TextField';
import Anexo from './Anexo';
import { Escolaridade } from './Escolaridade';
import { Validacao } from './Validacao'
import axios from 'axios';

function Formcv() {


    const initialValues = {
        nome: '',
        email: '',
        celular: '',
        cargo: '',
        escolaridade: '',
        obs: '',
        arquivo: undefined
    }


    return (
        <>
            <Formik
                initialValues={initialValues}
                /*validationSchema={Validacao} */
                onSubmit={data => {
                    console.log(data)

                    let formData = new FormData();
                    formData.append('nome', data.nome);
                    formData.append('email', data.email);
                    formData.append('celular', data.celular);
                    formData.append('cargo', data.cargo);
                    formData.append('escolaridade', data.escolaridade);
                    formData.append('obs', data.obs);
                    formData.append('arquivo', data.arquivo);

                    axios({
                        method: 'post',
                        url: 'http://localhost:90/ps-paytour/backend/index.php/',
                        data: formData,
                        config: {headers: {'Content-Type':'multipart/form-data'}}
                    })
                    .then(function (response){
                        console.log(response);
                        alert('Formulário enviado!')
                    })
                    .catch(function (response){
                        console.log(response)
                    });

                }}>
                {() => {
                    return (
                        <Form encType="multipart/form-data" action="index.php">
                            <TextField label="Nome" name="nome" type="text" />

                            <TextField label="E-mail" name="email" type="email" />

                            <TextField label="Celular" name="celular" type="tel" placeholder="Formato: 11 99111-9911" />

                            <TextField label="Cargo Desejado" name="cargo" type="text" />

                            <Escolaridade name="escolaridade" label="Escolaridade" placeholder="Selecione sua escolaridade" />

                            <TextField label="Observações" name="obs" type="text" placeholder="Opcional" />

                            <Anexo label="arquivo" />


                            <button className='btn btn-warning mt-2 ml-2' type="submit">Enviar CV</button>
                        </Form>

                    )
                }}
            </Formik>

        </>


    )

}
export default Formcv;