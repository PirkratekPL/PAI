<?php

namespace Application\Controller;

use Application\Model\Autor;
use Application\Form\AutorForm;
use Exception;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use PDO;

class AutorzyController extends AbstractActionController
{
    public function __construct(public Autor $autor, public AutorForm $autorForm)
    {
    }

    public function listaAction()
    {
        return [
            'autor' => $this->autor->pobierzSlownik(),
        ];
    }

    public function dodajAction()
    {
        $this->autorForm->get('zapisz')->setValue('Dodaj');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->autorForm->setData($request->getPost());

            if ($this->autorForm->isValid()) {
                $this->autor->dodaj($request->getPost());

                return $this->redirect()->toRoute('autorzy');
            }
        }

        return ['tytul' => 'Dodawanie autorów', 'form' => $this->autorForm];
    }

    public function edytujAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('autorzy');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->autorForm->setData($request->getPost());

            if ($this->autorForm->isValid()) {
                $this->autor->aktualizuj($id, $request->getPost());

                return $this->redirect()->toRoute('autorzy');
            }
        } else {
            $daneKsiazki = $this->autor->pobierz($id);
            $this->autorForm->setData($daneKsiazki);
        }

        $viewModel = new ViewModel(['tytul' => 'Edytuj Autora', 'form' => $this->autorForm]);
        $viewModel->setTemplate('application/autorzy/dodaj');

        return $viewModel;
    }
    public function szczegolyAction(){
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('autorzy');
        }
        $daneKsiazki = $this->autor->pobierz($id);
        
        $this->autorForm->setData($daneKsiazki);

        $viewModel = new ViewModel(['tytul' => 'Szczegóły', 'form' => $this->autorForm ]);
        $viewModel->setTemplate('application/autorzy/szczegoly');
        return $viewModel;
    }

    public function usunAction()
    {
        $id = (int)$this->params()->fromRoute('id');
        if (empty($id)) {
            $this->redirect()->toRoute('autorzy');
        }

        $request = $this->getRequest();
        $daneKsiazki = $this->autor->pobierz($id);
        $this->autorForm->setData($daneKsiazki);
        if ($request->isPost()) {
            try{
                $this->autor->usun($id);
            }
            catch(Exception $ex){
                echo "usuwanie kaskadowe jest niedozwolone tutaj";
            }
            
            return $this->redirect()->toRoute('autorzy');
        } 

        $viewModel = new ViewModel(['tytul' => 'Czy na pewno chcesz usunac autora?', 'form' => $this->autorForm]);
        $viewModel->setTemplate('application/autorzy/usun');

        return $viewModel;
    }
}
