import Base from './base';
import Row from './row';
import { OneDArray, TCell, TwoDArray } from './types';
declare class Tabular extends Base {
    private _rows;
    private _length;
    constructor(rows?: Row[] | Row);
    get rows(): Row[];
    set rows(rows: Row[]);
    get length(): number;
    set length(len: number);
    toArray(): TCell[][];
    /**
     * Creates a new Tabular from an array of Row(s)
     * This method generates a new ID for the Tabular and all nested elements
     *
     * @param rows
     * @returns Tabular
     */
    static fromRows(rows: Row[]): Tabular;
    /**
     * Creates a new Tabular from a 2D array
     * This method generates a new ID for the Tabular and all nested elements
     *
     * @param data
     * @returns Tabular
     */
    static fromArray<T extends TCell>(data: OneDArray<T> | TwoDArray<T>): Tabular;
}
export default Tabular;
