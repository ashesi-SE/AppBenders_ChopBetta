/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package se.com.chopbetta;

import java.util.ArrayList;

/**
 *
 * @author HP
 */
public class SimpleKVPair { 
    private ArrayList<String> key;
    private ArrayList<String> value;
    private int length;
    public SimpleKVPair(){
        key = new ArrayList<String>();
        value = new ArrayList<String>();
        length = 0;
    }
    public void put(String key, String value){
        this.key.add(key);
        this.value.add(value);
        length++;
    }
    public int getLength(){
        return length;
    }
    public String getKeyAt(int index){
        return this.key.get(index);
    }
    public String getValueAt(int index){
        return this.value.get(index);
    }
//    public String[] toArray(){
//        return this.value;
//    }
}
