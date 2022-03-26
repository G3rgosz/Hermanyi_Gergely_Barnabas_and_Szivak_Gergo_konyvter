import { TestBed } from '@angular/core/testing';

import { NewadvertisementService } from './newadvertisement.service';

describe('NewadvertisementService', () => {
  let service: NewadvertisementService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(NewadvertisementService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
