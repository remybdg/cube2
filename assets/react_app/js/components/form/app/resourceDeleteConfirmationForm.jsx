import React, { useState } from 'react'
import { connect } from 'react-redux';
import { Redirect } from 'react-router-dom';

import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';

import CategoryRepository from "../../../services/ORM/repository/CategoryRepository"

import { wrapComponent } from 'react-snackbar-alert';

import styled from 'styled-components'
import ResourceRepository from "../../../services/ORM/repository/ResourceRepository";
import {Delete} from "@material-ui/icons";

require("../../../../css/category.css");

const ResourceDeleteConfirmation = ({ dispatch,resourceId,AuthHandler, onCloseModal, refresh}) => {

    const handleSubmit = () => {
            ResourceRepository.deleteResource(resourceId, AuthHandler.token).then(res => {
                if(res.status === 204) {
                    onCloseModal()
                    refresh()
                }
            })
    }

    return (
        <div               style={{
            position: 'absolute',
            left: '50%',
            top: '50%',
            transform: 'translate(-50%, -50%)'
        }}>
            <Container>
                <Title>Supprimmer une resource ?</Title>
                <FormContainer>
                    <Button
                        onClick={null}
                        color='primary'
                        variant="true"
                        value={false}
                    >
                        Annuler
                    </Button>

                    <Button
                        onClick={handleSubmit}
                        color='primary'
                        variant="contained"
                        value="supprimer"
                    >
                       supprimer
                    </Button>

                </FormContainer>
            </Container>
        </div>
    )
}

const mapStateToProps = (state) => {
    return state
}

export default connect(mapStateToProps)(ResourceDeleteConfirmation)

const Title = styled.h3`
`

const FormContainer = styled.div`
	
`

const Container = styled.div`
	background-color: white;
	padding: 12px 24px;
	width: 100%;
	box-shadow: 0 0 6px 2px rgba(0,0,0,.1);
	border-bottom: 2px solid transparent;
	margin: 1%;
`

