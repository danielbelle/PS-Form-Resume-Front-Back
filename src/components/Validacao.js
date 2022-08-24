import * as Yup from 'yup';

export const Validacao =
    Yup.object({
        nome: Yup.string()
            .max(40, 'Deve ter 40 caracteres ou menos.')
            .required('Favor preencher, item obrigatório.'),

        email: Yup.string()
            .email('E-mail não válido')
            .required('Favor preencher, item obrigatório.'),

        celular: Yup.string()
            .matches(new RegExp('[0-9]{2} [0-9]{5}-[0-9]{4}'), 'Formato deve ser: 11 99111-9911')
            .required('Favor preencher, item obrigatório.'),

        cargo: Yup.string()
            .max(40, 'Deve ter 40 caracteres ou menos.')
            .required('Favor preencher, item obrigatório.'),

        arquivo: Yup.mixed()
            .required('Favor anexar seu CV, item obrigatório.')
            .test(
                "fileSize",
                "O arquivo tem mais de 1 MB",
                (file) => {
                    //console.log("file: ", file);
                    if (file) {
                        return file.size <= 1100000;
                    } else {
                        return true;
                    }
                }
            )
            .test(
                "fileType",
                "Aceitamos apenas .doc, .docx e .pdf",
                (file) =>
                    file && ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"].includes(file.type)
            )

    })

