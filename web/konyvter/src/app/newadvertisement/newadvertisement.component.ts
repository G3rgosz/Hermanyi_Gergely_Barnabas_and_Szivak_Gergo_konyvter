import { Component, OnInit } from '@angular/core';
import { NewadvertisementService } from '../shared/newadvertisement.service';
import { Router } from '@angular/router';
import { Validators, FormBuilder, FormArray, FormControl, FormGroup} from '@angular/forms';

@Component({
  selector: 'app-newadvertisement',
  templateUrl: './newadvertisement.component.html',
  styleUrls: ['./newadvertisement.component.css']
})
export class NewadvertisementComponent implements OnInit {

  genres:any;
  newadForm !: FormGroup;
  genreList: string[] =[];
  file: File | null = null;

  constructor(
    private newAdS: NewadvertisementService,
    private router: Router,
    private formBuilder: FormBuilder
  ) { 
    this.newadForm = this.formBuilder.group({

      website: this.formBuilder.array([], [Validators.required])

    })
  }

  ngOnInit(): void {
    this.newAdS.getGenres()
    .subscribe(
      (res) => {
        this.genres = res.data;
        console.log(this.genres);
      }, (error) => {
        console.error(error);
    });
    this.newadForm = new FormGroup({
      title: new FormControl('', [Validators.required,  Validators.maxLength(100)]),
      writer: new FormControl('', [Validators.required,  Validators.maxLength(255)]),
      publisher: new FormControl('', Validators.maxLength(255)),
      release: new FormControl('', [Validators.required, Validators.pattern("[-0-9]*$"), Validators.maxLength(5), Validators.min(-5000), Validators.max(2022)]),
      language: new FormControl('', Validators.maxLength(50)),
      genres: new FormControl(''),
      adtitle: new FormControl('', [Validators.required,  Validators.maxLength(50)]),
      price: new FormControl('', [Validators.required,  Validators.maxLength(11), Validators.pattern("[0-9]*$")]),
      image: new FormControl('', Validators.required),
      description: new FormControl('', [Validators.required,  Validators.minLength(20)])
    });
  }
  newAdvertisement(){
    
    let title = this.newadForm.value.title;
    let writer = this.newadForm.value.writer;
    let publisher = this.newadForm.value.publisher;
    let release = this.newadForm.value.release;
    let language = this.newadForm.value.language;
    let genres = this.genreList;
    let adtitle = this.newadForm.value.adtitle;
    let price = this.newadForm.value.price;
    let image = this.file;
    let description = this.newadForm.value.description;
    console.log(title,writer,publisher,release,language,genres,adtitle,price,image,description);
  }
  public checkboxController(genre:string){
    if(this.genreList.includes(genre)){
      let index = this.genreList.indexOf(genre);
      this.genreList.splice(index, 1);
    }else{
      this.genreList.push(genre);
    }
  }
  handleFileInput(event: any) {
    this.file = event.target.files[0]
}
}
