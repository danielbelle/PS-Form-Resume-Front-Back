import React from 'react';
import { useField } from 'formik';

export const Escolaridade = ({ label, ...props }) => {

    const [field, meta] = useField(props);
    return (
        <div className='mb-2'>
            <label htmlFor={field.name}>{label}</label>
            <select
                {...field}{...props}
                className={`form-select ${meta.touched && meta.error ? "input-error" : ""}`}
            >

                <option defaultValue="1">Ensino fundamental</option>
                <option defaultValue="2">Ensino médio incompleto</option>
                <option defaultValue="3">Ensino médio completo</option>
                <option defaultValue="4">Ensino superior incompleto</option>
                <option defaultValue="5">Ensino superior completo</option>
                <option defaultValue="6">Mestrado ou mais</option>
            </select>
            {meta.touched && meta.error && <div className="error">{meta.error}</div>}
        </div>
    )

}