package se.com.chopbetta;

import java.util.ArrayList;

/**
 * Created by HP on 10/8/2014.
 */
public class NotSoSimpleKVPair {
    private ArrayList<String> key;
    private ArrayList<String> mealName;
    private ArrayList<Float> mealRating;
    private ArrayList<Integer> ratedBy;
    private int length;
    public NotSoSimpleKVPair(){
        key = new ArrayList<String>();
        mealName = new ArrayList<String>();
        mealRating = new ArrayList<Float>();
        ratedBy = new ArrayList<Integer>();
        length = 0;
    }
    public void put(String key, String name,Float rating,Integer ratedby){
        this.key.add(key);
        this.mealName.add(name);
        this.mealRating.add(rating);
        this.ratedBy.add(ratedby);
        length++;
    }
    public int getLength(){
        return length;
    }
    public String getKeyAt(int index){
        return this.key.get(index);
    }
    public String getNameAt(int index){
        return this.mealName.get(index);
    }
    public Float getRateAt(int index){
        return this.mealRating.get(index);
    }
    public Integer getNumRatedAt(int index){  return this.ratedBy.get(index); }
//    public String[] toArray(){
//        return this.mealName;
//    }
}
