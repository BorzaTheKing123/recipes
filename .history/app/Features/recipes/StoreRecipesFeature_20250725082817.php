public function store ()
    {
        return (new StoreRecipesJob($this->request))->store();
    }