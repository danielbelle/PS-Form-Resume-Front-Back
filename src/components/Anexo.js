import React from 'react';
import { Field } from 'formik';


function Anexo() {
    const [file, setSelectedFile] = React.useState({
        file: undefined,
        previewURI: undefined
    });

    return (<Field name="arquivo">
        {({ form, ...rest }) => {
            // console.log(rest);
            return (
                <>
                    <label htmlFor='arquivo'>Adicionar seu CV</label>

                    <input
                        name="arquivo"
                        type="file"
                        className="form-control"
                        onBlur={form.handleBlur}
                        accept='.doc, .docx, .pdf'
                        onChange={({ currentTarget }) => {
                            const file = currentTarget.files[0];
                            const reader = new FileReader();

                            if (file) {
                                reader.onloadend = () => {
                                    setSelectedFile({
                                        file,
                                        previewURI: reader.result
                                    });
                                };
                                reader.readAsDataURL(file);
                                form.setFieldValue("arquivo", file);
                            }
                        }}
                    />{form.errors.arquivo && form.touched.arquivo ? (
                        <div
                            style={{
                                paddingTop: 5,
                                color: "#B2484D",
                                fontSize: ".75rem",
                                fontFamily: "Segoe UI"
                            }}
                        >
                            {JSON.stringify(form.errors.arquivo)}
                        </div>
                    ) : null}
                    <div className="form-text">Apenas formato .doc, .docx ou .pdf de tamanho máximo 1MB.</div>
                </>
            );
        }}
        
    </Field>
    
    )


}
export default Anexo;