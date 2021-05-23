<?
class Propositions_model extends CI_Model
{
    public function getUserProps($id)
    {
        $this->db->where('propositions.user_id', $id);
        $query = $this->db->get('propositions');
        return $query->result();
    }

    public function add($data)
    {
        $this->db->insert('propositions', $data);
    }

    public function findById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get("propositions");
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('propositions');
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('propositions');
    }

    public function getAll()
    {
        $this->db->from('users');
        $this->db->join('propositions', 'users.id = propositions.user_id');
        $this->db->where('propositions.soumission', 1);
        $query = $this->db->get();
        return $query->result();
    }
}
